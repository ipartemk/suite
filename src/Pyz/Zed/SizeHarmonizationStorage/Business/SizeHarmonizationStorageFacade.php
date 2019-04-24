<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonizationStorage\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\SizeHarmonizationStorage\Business\SizeHarmonizationStorageBusinessFactory getFactory()
 */
class SizeHarmonizationStorageFacade extends AbstractFacade implements SizeHarmonizationStorageFacadeInterface
{
    /**
     * @param array $attributeMotherGridIds
     *
     * @return void
     */
    public function publishAttributeMotherGrid(array $attributeMotherGridIds): void
    {
        $this->getFactory()
            ->createAttributeMotherGridStorageWriter()
            ->publish($attributeMotherGridIds);
    }

    /**
     * @param array $attributeMotherGridIds
     *
     * @return void
     */
    public function unpublishAttributeMotherGrid(array $attributeMotherGridIds): void
    {
        $this->getFactory()
            ->createAttributeMotherGridStorageWriter()
            ->unpublish($attributeMotherGridIds);
    }

    /**
     * @param array $productAbstractIds
     *
     * @return void
     */
    public function publishAttributeGrid(array $productAbstractIds): void
    {
        $this->getFactory()
            ->createAttributeGridStorageWriter()
            ->publish($productAbstractIds);
    }

    /**
     * @param array $productAbstractIds
     *
     * @return void
     */
    public function unpublishAttributeGrid(array $productAbstractIds): void
    {
        $this->getFactory()
            ->createAttributeGridStorageWriter()
            ->unpublish($productAbstractIds);
    }
}
