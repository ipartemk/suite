<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\SizeHarmonizationStorage;

use Generated\Shared\Transfer\AttributeGridProductAbstractStorageTransfer;
use Generated\Shared\Transfer\AttributeMotherGridStorageTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Pyz\Client\SizeHarmonizationStorage\SizeHarmonizationStorageFactory getFactory()
 */
class SizeHarmonizationStorageClient extends AbstractClient implements SizeHarmonizationStorageClientInterface
{
    /**
     * @param int $idAttributeMotherGrid
     *
     * @return \Generated\Shared\Transfer\AttributeMotherGridStorageTransfer|null
     */
    public function findAttributeMotherGrid($idAttributeMotherGrid): ?AttributeMotherGridStorageTransfer
    {
        return $this->getFactory()
            ->createAttributeMotherGridStorageReader()
            ->findAttributeMotherGrid($idAttributeMotherGrid);
    }

    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\AttributeGridProductAbstractStorageTransfer|null
     */
    public function findAttributeGridProductAbstract($idProductAbstract): ?AttributeGridProductAbstractStorageTransfer
    {
        return $this->getFactory()
            ->createAttributeGridStorageReader()
            ->findAttributeGridProductAbstract($idProductAbstract);
    }

    /**
     * @return \Pyz\Client\SizeHarmonizationStorage\Zed\SizeHarmonizationStorageStubInterface
     */
    protected function getZedStub()
    {
        return $this->getFactory()->createZedStub();
    }
}
