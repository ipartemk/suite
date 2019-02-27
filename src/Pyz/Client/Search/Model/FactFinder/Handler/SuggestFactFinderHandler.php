<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search\Model\FactFinder\Handler;

use Exception;
use Generated\Shared\Transfer\FactFinderSuggestRequestTransfer;
use Pyz\Client\Search\Api\Adapter\FactFinderSuggestAdapterInterface;
use Pyz\Client\Search\Model\FactFinder\Mapper\FactFinderToElasticaMapperInterface;
use Spryker\Client\Locale\LocaleClientInterface;
use Spryker\Client\Search\Exception\SearchResponseException;
use Spryker\Client\Search\Model\Handler\SearchHandlerInterface;
use Spryker\Client\Store\StoreClientInterface;

class SuggestFactFinderHandler extends FactFinderHandler implements SearchHandlerInterface
{
    /**
     * @var \Pyz\Client\Search\Api\Adapter\FactFinderSuggestAdapterInterface
     */
    protected $factFinderSuggestAdapter;

    /**
     * @param \Pyz\Client\Search\Model\FactFinder\Mapper\FactFinderToElasticaMapperInterface $factFinderToElasticaMapper
     * @param \Spryker\Client\Locale\LocaleClientInterface $localeClient
     * @param \Spryker\Client\Store\StoreClientInterface $storeClient
     * @param \Pyz\Client\Search\Api\Adapter\FactFinderSuggestAdapterInterface $factFinderSuggestAdapter
     */
    public function __construct(
        FactFinderToElasticaMapperInterface $factFinderToElasticaMapper,
        LocaleClientInterface $localeClient,
        StoreClientInterface $storeClient,
        FactFinderSuggestAdapterInterface $factFinderSuggestAdapter
    ) {
        parent::__construct($factFinderToElasticaMapper, $localeClient, $storeClient);

        $this->factFinderSuggestAdapter = $factFinderSuggestAdapter;
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
            // mocked part in data/FF/response_FF_Suggest.json
            $rawSearchResult = file_get_contents(APPLICATION_ROOT_DIR . '/data/FF/response_FF_Suggest.json');
            $searchResult = json_decode($rawSearchResult, true);

            // new approach!!! Real search request here
            $factFinderSuggestRequestTransfer = new FactFinderSuggestRequestTransfer();
            $factFinderSuggestResponseTransfer = $this->factFinderSuggestAdapter->request($factFinderSuggestRequestTransfer);

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
