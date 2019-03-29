<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Business\Manager;

use Generated\Shared\Transfer\AttributeMotherGridValueTransfer;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValue;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer;

class AttributeMotherGridValueManager
{
    /**
     * @var \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer
     */
    protected $sizeHarmonizationQueryContainer;

    /**
     * @param \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer $sizeHarmonizationQueryContainer
     */
    public function __construct(
        SizeHarmonizationQueryContainer $sizeHarmonizationQueryContainer
    ) {
        $this->sizeHarmonizationQueryContainer = $sizeHarmonizationQueryContainer;
    }

    /**
     * @param \Generated\Shared\Transfer\AttributeMotherGridValueTransfer $attributeMotherGridValueTransfer
     *
     * @return int
     */
    public function addAttributeMotherGridValue(AttributeMotherGridValueTransfer $attributeMotherGridValueTransfer): int
    {
        $attributeMotherGridValueEntity = new MytAttributeMotherGridValue();
        $attributeMotherGridValueEntity->fromArray($attributeMotherGridValueTransfer->toArray());

        $attributeMotherGridValueEntity->save();

        return $attributeMotherGridValueEntity->getIdAttributeMotherGridValue();
    }

    /**
     * @param \Generated\Shared\Transfer\AttributeMotherGridValueTransfer $attributeMotherGridValueTransfer
     *
     * @return bool
     */
    public function updateAttributeMotherGridValue(AttributeMotherGridValueTransfer $attributeMotherGridValueTransfer): bool
    {
        $attributeMotherGridValueEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridValueById($attributeMotherGridValueTransfer->getIdAttributeMotherGridValue())
            ->findOne();

        if (!$attributeMotherGridValueEntity) {
            return false;
        }

        $attributeMotherGridValueEntity->fromArray($attributeMotherGridValueTransfer->toArray());
        $attributeMotherGridValueEntity->save();

        return true;
    }
}
