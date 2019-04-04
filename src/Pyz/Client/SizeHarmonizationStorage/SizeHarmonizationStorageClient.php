<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\SizeHarmonizationStorage;

use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Pyz\Client\SizeHarmonizationStorage\SizeHarmonizationStorageFactory getFactory()
 */
class SizeHarmonizationStorageClient extends AbstractClient implements SizeHarmonizationStorageClientInterface
{
    /**
     * @return \Pyz\Client\SizeHarmonizationStorage\Zed\SizeHarmonizationStorageStubInterface
     */
    protected function getZedStub()
    {
        return $this->getFactory()->createZedStub();
    }
}
