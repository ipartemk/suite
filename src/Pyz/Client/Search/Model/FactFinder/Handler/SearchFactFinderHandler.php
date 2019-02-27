<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search\Model\FactFinder\Handler;

use Exception;
use Generated\Shared\Transfer\FactFinderSearchRequestTransfer;
use Pyz\Client\Search\Api\Adapter\FactFinderSearchAdapterInterface;
use Pyz\Client\Search\Model\FactFinder\Mapper\FactFinderToElasticaMapperInterface;
use Spryker\Client\Locale\LocaleClientInterface;
use Spryker\Client\Search\Exception\SearchResponseException;
use Spryker\Client\Search\Model\Handler\SearchHandlerInterface;
use Spryker\Client\Store\StoreClientInterface;

class SearchFactFinderHandler extends FactFinderHandler implements SearchHandlerInterface
{
    /**
     * @var \Pyz\Client\Search\Api\Adapter\FactFinderSearchAdapterInterface
     */
    protected $factFinderSearchAdapter;

    /**
     * @param \Pyz\Client\Search\Model\FactFinder\Mapper\FactFinderToElasticaMapperInterface $factFinderToElasticaMapper
     * @param \Spryker\Client\Locale\LocaleClientInterface $localeClient
     * @param \Spryker\Client\Store\StoreClientInterface $storeClient
     * @param \Pyz\Client\Search\Api\Adapter\FactFinderSearchAdapterInterface $factFinderSuggestAdapter
     */
    public function __construct(
        FactFinderToElasticaMapperInterface $factFinderToElasticaMapper,
        LocaleClientInterface $localeClient,
        StoreClientInterface $storeClient,
        FactFinderSearchAdapterInterface $factFinderSuggestAdapter
    ) {
        parent::__construct($factFinderToElasticaMapper, $localeClient, $storeClient);

        $this->factFinderSearchAdapter = $factFinderSuggestAdapter;
    }

    /**
     * @param mixed $query
     * @param array $requestParameters
     *
     * @throws \Spryker\Client\Search\Exception\SearchResponseException
     *
     * @return array
     */
    protected function executeQuery($query, array $requestParameters): array
    {
        try {
            // mocked part in data/FF/response.json
            $rawSearchResult = file_get_contents(APPLICATION_ROOT_DIR . '/data/FF/response_FF.json');
            $searchResult = json_decode($rawSearchResult, true);

            // new approach!!! Real search request here
            $factFinderSearchRequestTransfer = new FactFinderSearchRequestTransfer();
            $factFinderSearchResponseTransfer = $this->factFinderSearchAdapter->request($factFinderSearchRequestTransfer);

        } catch (Exception $e) {
            $rawQuery = json_encode($query->toArray());

            throw new SearchResponseException(
                sprintf("Search failed with the following reason: %s. Query: %s", $e->getMessage(), $rawQuery),
                $e->getCode(),
                $e
            );
        }

        return $searchResult;
    }
}
