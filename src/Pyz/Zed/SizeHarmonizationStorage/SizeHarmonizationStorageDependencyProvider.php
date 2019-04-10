<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonizationStorage;

use Pyz\Zed\SizeHarmonizationStorage\Dependency\Facade\SizeHarmonizationStorageToEventBehaviorFacadeBridge;
use Pyz\Zed\SizeHarmonizationStorage\Dependency\QueryContainer\SizeHarmonizationStorageToSizeHarmonizationQueryContainerBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SizeHarmonizationStorageDependencyProvider extends AbstractBundleDependencyProvider
{
    public const QUERY_CONTAINER_ATTRIBUTE_MOTHER_GRID = 'QUERY_CONTAINER_ATTRIBUTE_MOTHER_GRID';
    public const FACADE_EVENT_BEHAVIOR = 'FACADE_EVENT_BEHAVIOR';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container[static::FACADE_EVENT_BEHAVIOR] = function (Container $container) {
            return new SizeHarmonizationStorageToEventBehaviorFacadeBridge(
                $container->getLocator()->eventBehavior()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container)
    {
        $container[static::QUERY_CONTAINER_ATTRIBUTE_MOTHER_GRID] = function (Container $container) {
            return new SizeHarmonizationStorageToSizeHarmonizationQueryContainerBridge(
                $container->getLocator()->sizeHarmonization()->queryContainer()
            );
        };

        return $container;
    }
}
