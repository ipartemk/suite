<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search;

use Elastica\ResultSet\DefaultBuilder;
use GuzzleHttp\Client;
use Pyz\Client\Search\Api\Adapter\FactFinderSearchAdapter;
use Pyz\Client\Search\Api\Adapter\FactFinderSearchAdapterInterface;
use Pyz\Client\Search\Api\Adapter\FactFinderSuggestAdapter;
use Pyz\Client\Search\Api\Adapter\FactFinderSuggestAdapterInterface;
use Pyz\Client\Search\Api\Converter\FactFinderSearchRequestConverter;
use Pyz\Client\Search\Api\Converter\FactFinderSearchRequestConverterInterface;
use Pyz\Client\Search\Api\Converter\FactFinderSearchResponseConverter;
use Pyz\Client\Search\Api\Converter\FactFinderSearchResponseConverterInterface;
use Pyz\Client\Search\Api\Converter\FactFinderSuggestRequestConverter;
use Pyz\Client\Search\Api\Converter\FactFinderSuggestRequestConverterInterface;
use Pyz\Client\Search\Api\Converter\FactFinderSuggestResponseConverter;
use Pyz\Client\Search\Api\Converter\FactFinderSuggestResponseConverterInterface;
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
 * @method \Pyz\Client\Search\SearchConfig getConfig()
 */
class SearchFactory extends SprykerSearchFactory
{
    /**
     * @return \Pyz\Client\Search\Api\Adapter\FactFinderSearchAdapterInterface
     */
    public function createFactFinderSearchAdapter(): FactFinderSearchAdapterInterface
    {
        return new FactFinderSearchAdapter(
            $this->createGuzzleHttpClient(),
            $this->createFactFinderSearchRequestConverter(),
            $this->createFactFinderSearchResponseConverter(),
            $this->getConfig()
        );
    }

    /**
     * @return \Pyz\Client\Search\Api\Adapter\FactFinderSuggestAdapterInterface
     */
    public function createFactFinderSuggestAdapter(): FactFinderSuggestAdapterInterface
    {
        return new FactFinderSuggestAdapter(
            $this->createGuzzleHttpClient(),
            $this->createFactFinderSuggestRequestConverter(),
            $this->createFactFinderSuggestResponseConverter(),
            $this->getConfig()
        );
    }

    /**
     * @return \Pyz\Client\Search\Api\Converter\FactFinderSearchRequestConverterInterface
     */
    public function createFactFinderSearchRequestConverter(): FactFinderSearchRequestConverterInterface
    {
        return new FactFinderSearchRequestConverter();
    }

    /**
     * @return \Pyz\Client\Search\Api\Converter\FactFinderSearchResponseConverterInterface
     */
    public function createFactFinderSearchResponseConverter(): FactFinderSearchResponseConverterInterface
    {
        return new FactFinderSearchResponseConverter();
    }

    /**
     * @return \Pyz\Client\Search\Api\Converter\FactFinderSuggestRequestConverterInterface
     */
    public function createFactFinderSuggestRequestConverter(): FactFinderSuggestRequestConverterInterface
    {
        return new FactFinderSuggestRequestConverter();
    }

    /**
     * @return \Pyz\Client\Search\Api\Converter\FactFinderSuggestResponseConverterInterface
     */
    public function createFactFinderSuggestResponseConverter(): FactFinderSuggestResponseConverterInterface
    {
        return new FactFinderSuggestResponseConverter();
    }

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
            $this->getStoreClient(),
            $this->createFactFinderSearchAdapter()
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
            $this->getStoreClient(),
            $this->createFactFinderSuggestAdapter()
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
     * @return \GuzzleHttp\Client
     */
    protected function createGuzzleHttpClient()
    {
        return new Client();
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
