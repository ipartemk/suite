<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Glue\SizeHarmonizationRestApi;

use Pyz\Glue\SizeHarmonizationRestApi\Dependency\Client\SizeHarmonizationRestApiToSizeHarmonizationStorageClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

/**
 * @method \Pyz\Glue\SizeHarmonizationRestApi\SizeHarmonizationRestApiConfig getConfig()
 */
class SizeHarmonizationRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_CATEGORY_STORAGE = 'CLIENT_CATEGORY_STORAGE';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = $this->addCategoryStorageClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addCategoryStorageClient(Container $container): Container
    {
        $container[static::CLIENT_CATEGORY_STORAGE] = function (Container $container) {
            return new SizeHarmonizationRestApiToSizeHarmonizationStorageClientBridge(
                $container->getLocator()->sizeHarmonizationStorage()->client()
            );
        };

        return $container;
    }
}
