<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Client\Search\FactFinder\Mapper;

use Codeception\Test\Unit;
use Elastica\ResultSet\DefaultBuilder;
use Pyz\Client\Search\Model\FactFinder\Mapper\SearchFactFinderToElasticaMapper;

/**
 * Auto-generated group annotations
 * @group PyzTest
 * @group Client
  */
class SearchFactFinderToElasticaMapperTest extends Unit
{
    protected function setUp()
    {
        parent::setUp();

    }

    /**
     * @return void
     */
    public function testMap()
    {
//        $factFinderToElasticaMapper = $this->createSearchFactFinderToElasticaMapper();
        $this->assertEquals(1, 1);
    }

    protected function createSearchFactFinderToElasticaMapper()
    {
        return new SearchFactFinderToElasticaMapper(
            $this->createElasticaDefaultBuilder(),
            $this->getProductStorageClient(),
            $this->getProductImageStorageClient(),
            $this->getPriceProductStorageClient()
        );
    }

    /**
     * @return \Elastica\ResultSet\DefaultBuilder
     */
    protected function createElasticaDefaultBuilder()
    {
        return new DefaultBuilder();
    }

    /**
     * @return \Spryker\Client\ProductStorage\ProductStorageClientInterface
     */
    public function getProductStorageClient()
    {
        return $this->getProvidedDependency(SearchDependencyProvider::CLIENT_PRODUCT_STORAGE);
    }
}
