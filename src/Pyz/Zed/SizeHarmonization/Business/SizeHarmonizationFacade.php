<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Business;

use Generated\Shared\Transfer\AttributeMotherGridTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\SizeHarmonization\Business\SizeHarmonizationBusinessFactory getFactory()
 */
class SizeHarmonizationFacade extends AbstractFacade implements SizeHarmonizationFacadeInterface
{
    /**
     * {@inheritdoc}
     *
     * @param \Generated\Shared\Transfer\AttributeMotherGridTransfer $attributeMotherGridTransfer
     *
     * @return int
     */
    public function addAttributeMotherGrid(AttributeMotherGridTransfer $attributeMotherGridTransfer):int
    {
        return $this->getFactory()
            ->createAttributeMotherGridManager()
            ->addAttributeMotherGrid($attributeMotherGridTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @param \Generated\Shared\Transfer\AttributeMotherGridTransfer $attributeMotherGridTransfer
     *
     * @return bool
     */
    public function updateAttributeMotherGrid(AttributeMotherGridTransfer $attributeMotherGridTransfer):bool
    {
        return $this->getFactory()
            ->createAttributeMotherGridManager()
            ->updateAttributeMotherGrid($attributeMotherGridTransfer);
    }
}
