<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\SizeHarmonizationStorage;

use Pyz\Client\SizeHarmonizationStorage\Storage\AttributeMotherGridStorageReader;
use Pyz\Client\SizeHarmonizationStorage\Zed\SizeHarmonizationStorageStub;
use Spryker\Client\Kernel\AbstractFactory;

class SizeHarmonizationStorageFactory extends AbstractFactory
{
    /**
     * @return \Pyz\Client\SizeHarmonizationStorage\Zed\SizeHarmonizationStorageStubInterface
     */
    public function createZedStub()
    {
        return new SizeHarmonizationStorageStub($this->getZedRequestClient());
    }

    /**
     * @return \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected function getZedRequestClient()
    {
        return $this->getProvidedDependency(SizeHarmonizationStorageDependencyProvider::CLIENT_ZED_REQUEST);
    }

    /**
     * @return \Pyz\Client\SizeHarmonizationStorage\Storage\AttributeMotherGridStorageReader
     */
    public function createAttributeMotherGridStorageReader()
    {
        return new AttributeMotherGridStorageReader($this->getStorage(), $this->getSynchronizationService());
    }

    /**
     * @return \Spryker\Client\ProductCategoryStorage\Dependency\Client\ProductCategoryStorageToStorageClientInterface
     */
    protected function getStorage()
    {
        return $this->getProvidedDependency(SizeHarmonizationStorageDependencyProvider::CLIENT_STORAGE);
    }

    /**
     * @return \Spryker\Client\ProductCategoryStorage\Dependency\Service\ProductCategoryStorageToSynchronizationServiceBridge
     */
    protected function getSynchronizationService()
    {
        return $this->getProvidedDependency(SizeHarmonizationStorageDependencyProvider::SERVICE_SYNCHRONIZATION);
    }
}
