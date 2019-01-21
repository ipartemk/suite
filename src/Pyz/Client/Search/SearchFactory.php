<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search;

use Elastica\ResultSet\DefaultBuilder;
use Pyz\Client\Search\Model\FactFinder\Handler\SearchFactFinderHandler;
use Pyz\Client\Search\Model\FactFinder\Handler\SuggestFactFinderHandler;
use Pyz\Client\Search\Model\FactFinder\Mapper\FactFinderToElasticaMapperInterface;
use Pyz\Client\Search\Model\FactFinder\Mapper\SearchFactFinderToElasticaMapper;
use Pyz\Client\Search\Model\FactFinder\Mapper\SuggestFactFinderToElasticaMapper;
use Pyz\Client\Search\Model\Resolver\SearchResolver;
use Spryker\Client\Locale\LocaleClientInterface;
use Spryker\Client\PriceProductStorage\PriceProductStorageClientInterface;
use Spryker\Client\ProductImageStorage\ProductImageStorageClientInterface;
use Spryker\Client\ProductStorage\ProductStorageClientInterface;
use Spryker\Client\Search\Model\Handler\SearchHandlerInterface;
use Spryker\Client\Search\SearchFactory as SprykerSearchFactory;
use Spryker\Client\Store\StoreClientInterface;

/**
 * @method \Spryker\Client\Search\SearchConfig getConfig()
 */
class SearchFactory extends SprykerSearchFactory
{
    /**
     * @return \Pyz\Client\Search\Model\Resolver\SearchResolver
     */
    public function createSearchResolver(): SearchResolver
    {
        return new SearchResolver($this);
    }

    /**
     * @return \Spryker\Client\Search\Model\Handler\SearchHandlerInterface
     */
    public function createSearchFactFinderHandler(): SearchHandlerInterface
    {
        return new SearchFactFinderHandler(
            $this->createSearchFactFinderToElasticaMapper(),
            $this->getLocaleClient(),
            $this->getStoreClient()
        );
    }

    /**
     * @return \Spryker\Client\Search\Model\Handler\SearchHandlerInterface
     */
    public function createSuggestFactFinderHandler(): SearchHandlerInterface
    {
        return new SuggestFactFinderHandler(
            $this->createSuggestFactFinderToElasticaMapper(),
            $this->getLocaleClient(),
            $this->getStoreClient()
        );
    }

    /**
     * @return \Pyz\Client\Search\Model\FactFinder\Mapper\FactFinderToElasticaMapperInterface
     */
    public function createSearchFactFinderToElasticaMapper(): FactFinderToElasticaMapperInterface
    {
        return new SearchFactFinderToElasticaMapper(
            $this->createElasticaDefaultBuilder(),
            $this->getProductStorageClient(),
            $this->getProductImageStorageClient(),
            $this->getPriceProductStorageClient()
        );
    }

    /**
     * @return \Pyz\Client\Search\Model\FactFinder\Mapper\FactFinderToElasticaMapperInterface
     */
    public function createSuggestFactFinderToElasticaMapper(): FactFinderToElasticaMapperInterface
    {
        return new SuggestFactFinderToElasticaMapper(
            $this->createElasticaDefaultBuilder(),
            $this->getProductStorageClient(),
            $this->getProductImageStorageClient(),
            $this->getPriceProductStorageClient()
        );
    }

    /**
     * @return \Elastica\ResultSet\DefaultBuilder
     */
    public function createElasticaDefaultBuilder(): DefaultBuilder
    {
        return new DefaultBuilder();
    }

    /**
     * @return \Spryker\Client\ProductStorage\ProductStorageClientInterface
     */
    public function getProductStorageClient(): ProductStorageClientInterface
    {
        return $this->getProvidedDependency(SearchDependencyProvider::CLIENT_PRODUCT_STORAGE);
    }

    /**
     * @return \Spryker\Client\ProductImageStorage\ProductImageStorageClientInterface
     */
    public function getProductImageStorageClient(): ProductImageStorageClientInterface
    {
        return $this->getProvidedDependency(SearchDependencyProvider::CLIENT_PRODUCT_IMAGE_STORAGE);
    }

    /**
     * @return \Spryker\Client\PriceProductStorage\PriceProductStorageClientInterface
     */
    public function getPriceProductStorageClient(): PriceProductStorageClientInterface
    {
        return $this->getProvidedDependency(SearchDependencyProvider::CLIENT_PRICE_PRODUCT_STORAGE);
    }

    /**
     * @return \Spryker\Client\Locale\LocaleClientInterface
     */
    public function getLocaleClient(): LocaleClientInterface
    {
        return $this->getProvidedDependency(SearchDependencyProvider::CLIENT_LOCALE);
    }

    /**
     * @return \Spryker\Client\Store\StoreClientInterface
     */
    public function getStoreClient(): StoreClientInterface
    {
        return $this->getProvidedDependency(SearchDependencyProvider::CLIENT_STORE);
    }
}
