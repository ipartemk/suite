<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\SizeHarmonization;

use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Pyz\Client\SizeHarmonization\SizeHarmonizationFactory getFactory()
 */
class SizeHarmonizationClient extends AbstractClient implements SizeHarmonizationClientInterface
{
    /**
     * @return \Pyz\Client\SizeHarmonization\Zed\SizeHarmonizationStubInterface
     */
    protected function getZedStub()
    {
        return $this->getFactory()->createZedStub();
    }
}
