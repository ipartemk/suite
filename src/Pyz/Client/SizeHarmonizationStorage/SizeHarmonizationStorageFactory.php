<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\SizeHarmonizationStorage;

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
}
