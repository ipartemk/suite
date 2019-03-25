<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\SizeHarmonization;

use Pyz\Client\SizeHarmonization\Zed\SizeHarmonizationStub;
use Spryker\Client\Kernel\AbstractFactory;

class SizeHarmonizationFactory extends AbstractFactory
{
    /**
     * @return \Pyz\Client\SizeHarmonization\Zed\SizeHarmonizationStubInterface
     */
    public function createZedStub()
    {
        return new SizeHarmonizationStub($this->getZedRequestClient());
    }

    /**
     * @return \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected function getZedRequestClient()
    {
        return $this->getProvidedDependency(SizeHarmonizationDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
