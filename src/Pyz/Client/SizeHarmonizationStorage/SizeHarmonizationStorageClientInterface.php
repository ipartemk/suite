<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\SizeHarmonizationStorage;

use Generated\Shared\Transfer\AttributeMotherGridStorageTransfer;

interface SizeHarmonizationStorageClientInterface
{
    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\AttributeMotherGridStorageTransfer|null
     */
    public function findProductAbstractCategory($idProductAbstract): ?AttributeMotherGridStorageTransfer;
}
