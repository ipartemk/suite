<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\SizeHarmonizationStorage;

use Generated\Shared\Transfer\AttributeMotherGridStorageTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Pyz\Client\SizeHarmonizationStorage\SizeHarmonizationStorageFactory getFactory()
 */
class SizeHarmonizationStorageClient extends AbstractClient implements SizeHarmonizationStorageClientInterface
{
    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\AttributeMotherGridStorageTransfer|null
     */
    public function findProductAbstractCategory($idProductAbstract): ?AttributeMotherGridStorageTransfer
    {
        return $this->getFactory()
            ->createAttributeMotherGridStorageReader()
            ->findAttributeMotherGrid($idProductAbstract);
    }

    /**
     * @return \Pyz\Client\SizeHarmonizationStorage\Zed\SizeHarmonizationStorageStubInterface
     */
    protected function getZedStub()
    {
        return $this->getFactory()->createZedStub();
    }
}
