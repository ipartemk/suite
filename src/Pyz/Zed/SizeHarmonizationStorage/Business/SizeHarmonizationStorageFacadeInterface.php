<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonizationStorage\Business;

interface SizeHarmonizationStorageFacadeInterface
{
    /**
     * @param array $attributeMotherGridIds
     *
     * @return void
     */
    public function publishAttributeMotherGrid(array $attributeMotherGridIds): void;

    /**
     * @param array $attributeMotherGridIds
     *
     * @return void
     */
    public function unpublishAttributeMotherGrid(array $attributeMotherGridIds): void;

    /**
     * @param array $productAbstractIds
     *
     * @return void
     */
    public function publishAttributeGrid(array $productAbstractIds): void;

    /**
     * @param array $productAbstractIds
     *
     * @return void
     */
    public function unpublishAttributeGrid(array $productAbstractIds): void;
}
