<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Business\Manager;

use Generated\Shared\Transfer\AttributeGridValueTransfer;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridValue;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer;

class AttributeGridValueManager
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
     * @param \Generated\Shared\Transfer\AttributeGridValueTransfer $attributeGridValueTransfer
     *
     * @return int
     */
    public function addAttributeGridValue(AttributeGridValueTransfer $attributeGridValueTransfer): int
    {
        $attributeGridValueEntity = new MytAttributeGridValue();
        $attributeGridValueEntity->fromArray($attributeGridValueTransfer->toArray());

        $attributeGridValueEntity->save();

        return $attributeGridValueEntity->getIdAttributeGridValue();
    }

    /**
     * @param \Generated\Shared\Transfer\AttributeGridValueTransfer $attributeGridValueTransfer
     *
     * @return bool
     */
    public function updateAttributeGridValue(AttributeGridValueTransfer $attributeGridValueTransfer): bool
    {
        $attributeGridValueEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeGridValueById($attributeGridValueTransfer->getIdAttributeGridValue())
            ->findOne();

        if (!$attributeGridValueEntity) {
            return false;
        }

        $attributeGridValueEntity->fromArray($attributeGridValueTransfer->toArray());
        $attributeGridValueEntity->save();

        return true;
    }

    /**
     * @param int $idAttributeGridValue
     *
     * @return void
     */
    public function deleteAttributeGridValue($idAttributeGridValue): void
    {
        $attributeGridValueEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeGridValueById($idAttributeGridValue)
            ->findOne();

        if ($attributeGridValueEntity) {
            $attributeGridValueEntity->delete();
        }
    }
}
