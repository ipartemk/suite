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
    public function publish(array $attributeMotherGridIds): void
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
    public function unpublish(array $attributeMotherGridIds): void
    {
        $this->getFactory()
            ->createAttributeMotherGridStorageWriter()
            ->unpublish($attributeMotherGridIds);
    }
}
