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
use Spryker\Client\Store\StoreClientInterface;

class SuggestFactFinderToElasticaMapper extends AbstractFactFinderToElasticaMapper implements FactFinderToElasticaMapperInterface
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
     * @var \Spryker\Client\Store\StoreClientInterface
     */
    protected $storeClient;

    /**
     * @var string
     */
    protected $currentLocale;

    /**
     * @var \Generated\Shared\Transfer\StoreTransfer
     */
    protected $currentStore;

    /**
     * @param \Elastica\ResultSet\DefaultBuilder $elasticaDefaultBuilder
     * @param \Spryker\Client\ProductStorage\ProductStorageClientInterface $productStorageClient
     * @param \Spryker\Client\ProductImageStorage\ProductImageStorageClientInterface $productImageStorageClient
     * @param \Spryker\Client\PriceProductStorage\PriceProductStorageClientInterface $priceProductStorageClient
     * @param \Spryker\Client\Locale\LocaleClientInterface $localeClient
     * @param \Spryker\Client\Store\StoreClientInterface $storeClient
     */
    public function __construct(
        DefaultBuilder $elasticaDefaultBuilder,
        ProductStorageClientInterface $productStorageClient,
        ProductImageStorageClientInterface $productImageStorageClient,
        PriceProductStorageClientInterface $priceProductStorageClient,
        LocaleClientInterface $localeClient,
        StoreClientInterface $storeClient
    ) {
        parent::__construct($priceProductStorageClient);

        $this->elasticaDefaultBuilder = $elasticaDefaultBuilder;
        $this->productStorageClient = $productStorageClient;
        $this->productImageStorageClient = $productImageStorageClient;
        $this->localeClient = $localeClient;
        $this->storeClient = $storeClient;

        $this->currentLocale = $this->localeClient->getCurrentLocale();
        $this->currentStore = $this->storeClient->getCurrentStore();
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
        $elasticaResponseArray['hits'] = [];
        $elasticaResponseArray['aggregations'] = $this->mapElasticaAggregations($searchResult);

        return $elasticaResponseArray;
    }

    /**
     * @param array $searchResult
     *
     * @return array
     */
    protected function mapElasticaAggregations(array $searchResult): array
    {
        $aggregations = [];
        $aggregations['completion'] = $this->mapElasticaCompletion($searchResult);
        $aggregations['suggestion-by-type'] = $this->mapElasticaSuggestion($searchResult);

        return $aggregations;
    }

    /**
     * @param array $searchResult
     *
     * @return array
     */
    protected function mapElasticaCompletion(array $searchResult): array
    {
        $buckets = [];
        $ffSuggestCategoryItems = $this->findSuggestItemsByType($searchResult, 'category');
        $ffSuggestBrandItems = $this->findSuggestItemsByType($searchResult, 'brand');
        $ffSuggestItems = array_merge($ffSuggestCategoryItems, $ffSuggestBrandItems);

        foreach ($ffSuggestItems as $ffSuggestItem) {
            $bucket = [
                'key' => $ffSuggestItem['name'],
                'doc_count' => $ffSuggestItem['hitCount'],
            ];

            $buckets[] = $bucket;
        }

        $completion = [
            'doc_count_error_upper_bound' => 0,
            'sum_other_doc_count' => count($buckets),
            'buckets' => $buckets,
        ];

        return $completion;
    }

    /**
     * @param array $searchResult
     *
     * @return array
     */
    protected function mapElasticaSuggestion(array $searchResult): array
    {
        $buckets = [];
        $buckets[] = $this->mapElasticaProductBucket($searchResult);

        $suggestion = [
            'doc_count_error_upper_bound' => 0,
            'sum_other_doc_count' => 0,
            'buckets' => $buckets,
        ];

        return $suggestion;
    }

    /**
     * @param array $searchResult
     *
     * @return array
     */
    protected function mapElasticaProductBucket(array $searchResult): array
    {
        $ffSuggestItems = $this->findSuggestItemsByType($searchResult, 'productName');
        $hits = [];
        $maxScore = 0;
        foreach ($ffSuggestItems as $ffSuggestItem) {
            $productConcrete = $this->productStorageClient
                ->findProductConcreteStorageData(
                    $ffSuggestItem['attributes']['id'],
                    $this->currentLocale
                );
            if ($productConcrete === null) {
                continue;
            }
            $productAbstract = $this->productStorageClient
                ->findProductAbstractStorageData(
                    $productConcrete['id_product_abstract'],
                    $this->currentLocale
                );
            if ($productAbstract === null) {
                continue;
            }
            $maxScore = max($maxScore, $ffSuggestItem['score']);

            $productAbstractImageStorageTransfer = $this->productImageStorageClient
                ->findProductImageAbstractStorageTransfer(
                    $productAbstract['id_product_abstract'],
                    $this->currentLocale
                );

            $elasticaImages = $this->mapElasticaImages($productAbstractImageStorageTransfer);
            $elasticaPrices = $this->mapElasticaPrices($productAbstract);

            $hit = [
                '_index' => $this->currentLocale . '_search',
                '_type' => 'page',
                '_id' => $productAbstract['id_product_abstract'],
                '_score' => $ffSuggestItem['score'],
                '_source' => [
                    'store' => $this->currentStore->getName(),
                    'locale' => $this->currentLocale,
                    'type' => 'product_abstract',
                    'is-active' => true,
                    'search-result-data' =>
                        [
                            'id_product_abstract' => $productAbstract['id_product_abstract'],
                            'abstract_sku' => $productAbstract['sku'],
                            'abstract_name' => $productAbstract['name'],
                            'url' => $productAbstract['url'],
                            'type' => 'product_abstract',
                            'price' => 0,
                            'prices' => $elasticaPrices,
                            'images' => $elasticaImages,
                            'id_product_labels' => [],
                        ],
                    'full-text-boosted' => [],
                    'full-text' => [],
                    'suggestion-terms' => [],
                    'completion-terms' => [],
                    'string-sort' => [],
                    'integer-sort' => [],
                    'integer-facet' => [],
                    'category' => [],
                    'string-facet' => [],
                ],
            ];

            $hits[] = $hit;
        }

        if (!count($hits)) {
            return [];
        }

        $bucket = [
            'key' => 'product_abstract',
            'doc_count' => count($hits),
            'top-hits' => [
                'hits' =>  [
                    'total' => count($hits),
                    'max_score' => $maxScore,
                    'hits' => $hits,
                ],
            ],
        ];

        return $bucket;
    }

    /**
     * @param array $searchResult
     * @param $ffSuggestType
     *
     * @return array
     */
    protected function findSuggestItemsByType(array $searchResult, $ffSuggestType): array
    {
        $ffSuggestItems = [];
        foreach ($searchResult as $ffSuggestItem) {
            if ($ffSuggestItem['type'] == $ffSuggestType) {
                $ffSuggestItems[] = $ffSuggestItem;
            }
        }

        return $ffSuggestItems;
    }
}
