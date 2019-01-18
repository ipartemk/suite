<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search\Model\FactFinder\Mapper;

use Elastica\Query;
use Elastica\ResultSet;
use Elastica\ResultSet\DefaultBuilder;
use Spryker\Client\Locale\LocaleClientInterface;
use Spryker\Client\PriceProductStorage\PriceProductStorageClientInterface;
use Spryker\Client\ProductImageStorage\ProductImageStorageClientInterface;
use Spryker\Client\ProductStorage\ProductStorageClientInterface;

class SearchFactFinderToElasticaMapper extends AbstractFactFinderToElasticaMapper implements FactFinderToElasticaMapperInterface
{
    /**
     * @var \Elastica\ResultSet\DefaultBuilder
     */
    protected $elasticaDefaultBuilder;

    /**
     * @var \Spryker\Client\ProductStorage\ProductStorageClientInterface
     */
    protected $productStorageClient;

    /**
     * @var \Spryker\Client\ProductImageStorage\ProductImageStorageClientInterface
     */
    protected $productImageStorageClient;

    /**
     * @var \Spryker\Client\Locale\LocaleClientInterface
     */
    protected $localeClient;

    /**
     * @var string
     */
    protected $currentLocale;

    /**
     * @param \Elastica\ResultSet\DefaultBuilder $elasticaDefaultBuilder
     * @param \Spryker\Client\ProductStorage\ProductStorageClientInterface $productStorageClient
     * @param \Spryker\Client\ProductImageStorage\ProductImageStorageClientInterface $productImageStorageClient
     * @param \Spryker\Client\PriceProductStorage\PriceProductStorageClientInterface $priceProductStorageClient
     * @param \Spryker\Client\Locale\LocaleClientInterface $localeClient
     */
    public function __construct(
        DefaultBuilder $elasticaDefaultBuilder,
        ProductStorageClientInterface $productStorageClient,
        ProductImageStorageClientInterface $productImageStorageClient,
        PriceProductStorageClientInterface $priceProductStorageClient,
        LocaleClientInterface $localeClient
    ) {
        parent::__construct($priceProductStorageClient);

        $this->elasticaDefaultBuilder = $elasticaDefaultBuilder;
        $this->productStorageClient = $productStorageClient;
        $this->productImageStorageClient = $productImageStorageClient;
        $this->localeClient = $localeClient;
        $this->currentLocale = $this->localeClient->getCurrentLocale();
    }

    /**
     * @param array $searchResult
     * @param \Elastica\Query $elasticaQuery
     *
     * @return \Elastica\ResultSet
     */
    public function map(array $searchResult, Query $elasticaQuery): ResultSet
    {
        $elasticaResponseArray = $this->mapSearchResultToElasticaResponseArray($searchResult);
        $elasticaResponse = new \Elastica\Response($elasticaResponseArray,200);

        return $this->elasticaDefaultBuilder->buildResultSet($elasticaResponse, $elasticaQuery);
    }

    /**
     * @param array $searchResult
     *
     * @return array
     */
    protected function mapSearchResultToElasticaResponseArray(array $searchResult): array
    {

        $elasticaResponseArray = [
            'took' => 1,
            'timed_out' => false,
            '_shards' =>
                [
                    'total' => 1,
                    'successful' => 1,
                    'skipped' => 0,
                    'failed' => 0,
                ],
        ];
        $elasticaResponseArray['hits'] = $this->mapElasticaHits($searchResult);
        $elasticaResponseArray['aggregations'] = [];

        return $elasticaResponseArray;
    }

    /**
     * @param array $searchResult
     *
     * @return array
     */
    protected function mapElasticaHits(array $searchResult): array
    {

        $total = $searchResult['totalHits'];
        $maxScore = max($searchResult['scoreFirstHit'], $searchResult['scoreLastHit']);
        $elasticaHits = [];
        foreach ($searchResult['hits'] as $searchHit) {
            if (!count($searchHit['variantValues'])) {
                continue;
            }
            $concreteProduct = $searchHit['variantValues'][0];
            $productAbstract = $this->productStorageClient
                ->findProductAbstractStorageDataByMapping(
                    static::SKU_MAPPING_TYPE,
                    $concreteProduct['sku'],
                    $this->currentLocale
                );
            if ($productAbstract === null) {
                continue;
            }
            $productAbstractImageStorageTransfer = $this->productImageStorageClient
                ->findProductImageAbstractStorageTransfer(
                    $productAbstract['id_product_abstract'],
                    $this->currentLocale
                );

            $elasticaImages = $this->mapElasticaImages($productAbstractImageStorageTransfer);
            $elasticaPrices = $this->mapElasticaPrices($productAbstract);

            $elasticaHit = [
                '_index' => $this->currentLocale . '_search',
                '_type' => 'page',
                '_id' => $productAbstract['id_product_abstract'],
                '_score' => $searchHit['score'],
                '_source' =>
                    [
                        'search-result-data' =>
                            [
                                'images' => $elasticaImages,
                                'id_product_labels' => [],
                                'price' => 0,
                                'abstract_name' => $productAbstract['name'],
                                'id_product_abstract' => $productAbstract['id_product_abstract'],
                                'type' => 'product_abstract',
                                'prices' => $elasticaPrices,
                                'abstract_sku' => $productAbstract['sku'],
                                'url' => $productAbstract['url'],
                            ],
                    ],
            ];

            $elasticaHits[] = $elasticaHit;
        }


        return [
            'total' => $total,
            'max_score' => $maxScore,
            'hits' => $elasticaHits
        ];
    }
}
