<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search\Model\FactFinder\Handler;

use Elastica\ResultSet;
use Pyz\Client\Search\Model\FactFinder\Mapper\FactFinderToElasticaMapperInterface;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;
use Spryker\Client\Search\Model\Handler\SearchHandlerInterface;

abstract class FactFinderHandler implements SearchHandlerInterface
{
    /**
     * @var \Pyz\Client\Search\Model\FactFinder\Mapper\FactFinderToElasticaMapperInterface
     */
    protected $factFinderToElasticaMapper;

    /**
     * @param \Pyz\Client\Search\Model\FactFinder\Mapper\FactFinderToElasticaMapperInterface $factFinderToElasticaMapper
     */
    public function __construct(FactFinderToElasticaMapperInterface $factFinderToElasticaMapper)
    {
        $this->factFinderToElasticaMapper = $factFinderToElasticaMapper;
    }

    /**
     * @param \Spryker\Client\Search\Dependency\Plugin\QueryInterface $searchQuery
     * @param \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[] $resultFormatters
     * @param array $requestParameters
     *
     * @return array|\Elastica\ResultSet
     */
    public function search(QueryInterface $searchQuery, array $resultFormatters = [], array $requestParameters = [])
    {
        $elasticaQuery = $searchQuery->getSearchQuery();
        $searchResult = $this->executeQuery($elasticaQuery, $requestParameters);
        $elasticaSearchResult = $this->factFinderToElasticaMapper->map($searchResult, $elasticaQuery);

        if (!$resultFormatters) {
            return $elasticaSearchResult;
        }

        return $this->formatSearchResults($resultFormatters, $elasticaSearchResult, $requestParameters);
    }

    /**
     * @param \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[] $resultFormatters
     * @param \Elastica\ResultSet $rawSearchResult
     * @param array $requestParameters
     *
     * @return array
     */
    protected function formatSearchResults(
        array $resultFormatters,
        ResultSet $rawSearchResult,
        array $requestParameters
    ): array {
        $formattedSearchResult = [];

        foreach ($resultFormatters as $resultFormatter) {
            $formattedSearchResult[$resultFormatter->getName()] = $resultFormatter->formatResult($rawSearchResult, $requestParameters);
        }

        return $formattedSearchResult;
    }

    /**
     * @param mixed $query
     * @param array $requestParameters
     *
     * @throws \Spryker\Client\Search\Exception\SearchResponseException
     *
     * @return array
     */
    abstract protected function executeQuery($query, array $requestParameters): array;
}
