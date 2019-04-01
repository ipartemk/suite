<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Business;

use Generated\Shared\Transfer\AttributeGridGroupTransfer;
use Generated\Shared\Transfer\AttributeGridValueTransfer;
use Generated\Shared\Transfer\AttributeMotherGridKeyTransfer;
use Generated\Shared\Transfer\AttributeMotherGridTransfer;
use Generated\Shared\Transfer\AttributeMotherGridValueTransfer;
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
    public function addAttributeMotherGrid(AttributeMotherGridTransfer $attributeMotherGridTransfer): int
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
    public function updateAttributeMotherGrid(AttributeMotherGridTransfer $attributeMotherGridTransfer): bool
    {
        return $this->getFactory()
            ->createAttributeMotherGridManager()
            ->updateAttributeMotherGrid($attributeMotherGridTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @param \Generated\Shared\Transfer\AttributeMotherGridKeyTransfer $attributeMotherGridKeyTransfer
     *
     * @return int
     */
    public function addAttributeMotherGridKey(AttributeMotherGridKeyTransfer $attributeMotherGridKeyTransfer): int
    {
        return $this->getFactory()
            ->createAttributeMotherGridKeyManager()
            ->addAttributeMotherGridKey($attributeMotherGridKeyTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @param \Generated\Shared\Transfer\AttributeMotherGridKeyTransfer $attributeMotherGridKeyTransfer
     *
     * @return bool
     */
    public function updateAttributeMotherGridKey(AttributeMotherGridKeyTransfer $attributeMotherGridKeyTransfer): bool
    {
        return $this->getFactory()
            ->createAttributeMotherGridKeyManager()
            ->updateAttributeMotherGridKey($attributeMotherGridKeyTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @param \Generated\Shared\Transfer\AttributeMotherGridValueTransfer $attributeMotherGridValueTransfer
     *
     * @return int
     */
    public function addAttributeMotherGridValue(AttributeMotherGridValueTransfer $attributeMotherGridValueTransfer): int
    {
        return $this->getFactory()
            ->createAttributeMotherGridValueManager()
            ->addAttributeMotherGridValue($attributeMotherGridValueTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @param \Generated\Shared\Transfer\AttributeMotherGridValueTransfer $attributeMotherGridValueTransfer
     *
     * @return bool
     */
    public function updateAttributeMotherGridValue(AttributeMotherGridValueTransfer $attributeMotherGridValueTransfer): bool
    {
        return $this->getFactory()
            ->createAttributeMotherGridValueManager()
            ->updateAttributeMotherGridValue($attributeMotherGridValueTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @param \Generated\Shared\Transfer\AttributeGridGroupTransfer $attributeGridGroupTransfer
     *
     * @return int
     */
    public function addAttributeGridGroup(AttributeGridGroupTransfer $attributeGridGroupTransfer): int
    {
        return $this->getFactory()
            ->createAttributeGridGroupManager()
            ->addAttributeGridGroup($attributeGridGroupTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @param \Generated\Shared\Transfer\AttributeGridGroupTransfer $attributeGridGroupTransfer
     *
     * @return bool
     */
    public function updateAttributeGridGroup(AttributeGridGroupTransfer $attributeGridGroupTransfer): bool
    {
        return $this->getFactory()
            ->createAttributeGridGroupManager()
            ->updateAttributeMotherGrid($attributeGridGroupTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @param \Generated\Shared\Transfer\AttributeGridValueTransfer $attributeGridValueTransfer
     *
     * @return int
     */
    public function addAttributeGridValue(AttributeGridValueTransfer $attributeGridValueTransfer): int
    {
        return $this->getFactory()
            ->createAttributeGridValueManager()
            ->addAttributeGridValue($attributeGridValueTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @param \Generated\Shared\Transfer\AttributeGridValueTransfer $attributeGridValueTransfer
     *
     * @return bool
     */
    public function updateAttributeGridValue(AttributeGridValueTransfer $attributeGridValueTransfer): bool
    {
        return $this->getFactory()
            ->createAttributeGridValueManager()
            ->updateAttributeGridValue($attributeGridValueTransfer);
    }
}
