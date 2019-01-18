<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search\Model\FactFinder\Mapper;

use Elastica\Query;
use Elastica\ResultSet;

interface FactFinderToElasticaMapperInterface
{
    /**
     * @param array $searchResult
     * @param \Elastica\Query $elasticaQuery
     *
     * @return \Elastica\ResultSet
     */
    public function map(array $searchResult, Query $elasticaQuery): ResultSet;
}
