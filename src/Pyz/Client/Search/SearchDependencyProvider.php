<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search;

use Spryker\Client\Catalog\Plugin\Config\CatalogSearchConfigBuilder;
use Spryker\Client\Kernel\Container;
use Spryker\Client\ProductSearchConfigStorage\Plugin\Config\ProductSearchConfigExpanderPlugin;
use Spryker\Client\Search\SearchDependencyProvider as SprykerSearchDependencyProvider;

class SearchDependencyProvider extends SprykerSearchDependencyProvider
{
    public const CLIENT_PRODUCT_STORAGE = 'client product storage';
    public const CLIENT_PRODUCT_IMAGE_STORAGE = 'client product image storage';
    public const CLIENT_PRICE_PRODUCT_STORAGE = 'client price product storage';
    public const CLIENT_LOCALE = 'client locale';
    public const CLIENT_STORE = 'client store';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container)
    {
        $container = parent::provideServiceLayerDependencies($container);

        $container = $this->provideProductStorageClient($container);
        $container = $this->provideProductImageStorageClient($container);
        $container = $this->providePriceProductStorageClient($container);
        $container = $this->provideLocaleClient($container);
        $container = $this->provideStoreClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function provideProductStorageClient(Container $container)
    {
        $container[static::CLIENT_PRODUCT_STORAGE] = function (Container $container) {
            return $container->getLocator()->productStorage()->client();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function provideProductImageStorageClient(Container $container)
    {
        $container[static::CLIENT_PRODUCT_IMAGE_STORAGE] = function (Container $container) {
            return $container->getLocator()->productImageStorage()->client();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function providePriceProductStorageClient(Container $container)
    {
        $container[static::CLIENT_PRICE_PRODUCT_STORAGE] = function (Container $container) {
            return $container->getLocator()->priceProductStorage()->client();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function provideLocaleClient(Container $container)
    {
        $container[static::CLIENT_LOCALE] = function (Container $container) {
            return $container->getLocator()->locale()->client();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function provideStoreClient(Container $container)
    {
        $container[static::CLIENT_STORE] = function (Container $container) {
            return $container->getLocator()->store()->client();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\SearchConfigBuilderInterface
     */
    protected function createSearchConfigBuilderPlugin(Container $container)
    {
        return new CatalogSearchConfigBuilder();
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\SearchConfigExpanderPluginInterface[]
     */
    protected function createSearchConfigExpanderPlugins(Container $container)
    {
        $searchConfigExpanderPlugins = parent::createSearchConfigExpanderPlugins($container);

        $searchConfigExpanderPlugins[] = new ProductSearchConfigExpanderPlugin();

        return $searchConfigExpanderPlugins;
    }
}
