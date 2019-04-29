<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\SizeHarmonizationStorage;

use Generated\Shared\Transfer\AttributeGridProductAbstractStorageTransfer;
use Generated\Shared\Transfer\AttributeMotherGridStorageTransfer;

interface SizeHarmonizationStorageClientInterface
{
    /**
     * @param int $idAttributeMotherGrid
     *
     * @return \Generated\Shared\Transfer\AttributeMotherGridStorageTransfer|null
     */
    public function findAttributeMotherGrid($idAttributeMotherGrid): ?AttributeMotherGridStorageTransfer;

    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\AttributeGridProductAbstractStorageTransfer|null
     */
    public function findAttributeGridProductAbstract($idProductAbstract): ?AttributeGridProductAbstractStorageTransfer;
}
