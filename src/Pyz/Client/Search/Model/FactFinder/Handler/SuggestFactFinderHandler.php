<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search\Model\FactFinder\Handler;

use Exception;
use Spryker\Client\Search\Exception\SearchResponseException;
use Spryker\Client\Search\Model\Handler\SearchHandlerInterface;

class SuggestFactFinderHandler extends FactFinderHandler implements SearchHandlerInterface
{
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
            $rawSearchResult = file_get_contents(APPLICATION_ROOT_DIR . '/data/FF/response_FF_Suggest.json');
            $searchResult = json_decode($rawSearchResult, true);

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
