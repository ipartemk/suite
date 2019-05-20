<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonizationStorage\Communication;

use Pyz\Zed\SizeHarmonizationStorage\SizeHarmonizationStorageDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \Pyz\Zed\SizeHarmonizationStorage\Persistence\SizeHarmonizationStorageQueryContainer getQueryContainer()
 * @method \Pyz\Zed\SizeHarmonizationStorage\SizeHarmonizationStorageConfig getConfig()
 * @method \Pyz\Zed\SizeHarmonizationStorage\Business\SizeHarmonizationStorageFacadeInterface getFacade()
 */
class SizeHarmonizationStorageCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Pyz\Zed\SizeHarmonizationStorage\Dependency\Facade\SizeHarmonizationStorageToEventBehaviorFacadeBridge
     */
    public function getEventBehaviorFacade()
    {
        return $this->getProvidedDependency(SizeHarmonizationStorageDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }
}