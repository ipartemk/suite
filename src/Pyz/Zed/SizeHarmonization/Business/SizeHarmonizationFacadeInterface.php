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

interface SizeHarmonizationFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\AttributeMotherGridTransfer $attributeMotherGridTransfer
     *
     * @return int
     */
    public function addAttributeMotherGrid(AttributeMotherGridTransfer $attributeMotherGridTransfer): int;

    /**
     * @param \Generated\Shared\Transfer\AttributeMotherGridTransfer $attributeGridGroupTransfer
     *
     * @return bool
     */
    public function updateAttributeMotherGrid(AttributeMotherGridTransfer $attributeGridGroupTransfer): bool;

    /**
     * @param \Generated\Shared\Transfer\AttributeMotherGridKeyTransfer $attributeMotherGridKeyTransfer
     *
     * @return int
     */
    public function addAttributeMotherGridKey(AttributeMotherGridKeyTransfer $attributeMotherGridKeyTransfer): int;

    /**
     * @param \Generated\Shared\Transfer\AttributeMotherGridKeyTransfer $attributeMotherGridKeyTransfer
     *
     * @return bool
     */
    public function updateAttributeMotherGridKey(AttributeMotherGridKeyTransfer $attributeMotherGridKeyTransfer): bool;

    /**
     * @param \Generated\Shared\Transfer\AttributeMotherGridValueTransfer $attributeMotherGridValueTransfer
     *
     * @return int
     */
    public function addAttributeMotherGridValue(AttributeMotherGridValueTransfer $attributeMotherGridValueTransfer): int;

    /**
     * @param \Generated\Shared\Transfer\AttributeMotherGridValueTransfer $attributeMotherGridValueTransfer
     *
     * @return bool
     */
    public function updateAttributeMotherGridValue(AttributeMotherGridValueTransfer $attributeMotherGridValueTransfer): bool;

    /**
     * @param \Generated\Shared\Transfer\AttributeGridGroupTransfer $attributeGridGroupTransfer
     *
     * @return int
     */
    public function addAttributeGridGroup(AttributeGridGroupTransfer $attributeGridGroupTransfer): int;

    /**
     * @param \Generated\Shared\Transfer\AttributeGridGroupTransfer $attributeGridGroupTransfer
     *
     * @return bool
     */
    public function updateAttributeGridGroup(AttributeGridGroupTransfer $attributeGridGroupTransfer): bool;

    /**
     * @param \Generated\Shared\Transfer\AttributeGridValueTransfer $attributeGridValueTransfer
     *
     * @return int
     */
    public function addAttributeGridValue(AttributeGridValueTransfer $attributeGridValueTransfer): int;

    /**
     * @param \Generated\Shared\Transfer\AttributeGridValueTransfer $attributeGridValueTransfer
     *
     * @return bool
     */
    public function updateAttributeGridValue(AttributeGridValueTransfer $attributeGridValueTransfer): bool;
}
