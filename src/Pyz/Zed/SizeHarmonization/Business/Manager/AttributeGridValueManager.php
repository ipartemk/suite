<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Business\Manager;

use Generated\Shared\Transfer\AttributeGridValueTransfer;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridValue;
use Pyz\Zed\SizeHarmonization\Business\Exception\AttributeMotherGridCollisionException;
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
        $this->checkAttributeMotherGridConsistency($attributeGridValueTransfer);
        
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
        $this->checkAttributeMotherGridConsistency($attributeGridValueTransfer);

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
     * @param \Generated\Shared\Transfer\AttributeGridValueTransfer $attributeGridValueTransfer
     *
     * @throws \Pyz\Zed\SizeHarmonization\Business\Exception\AttributeMotherGridCollisionException
     */
    protected function checkAttributeMotherGridConsistency(AttributeGridValueTransfer $attributeGridValueTransfer)
    {
        $attributeMotherGridKeyEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridKey()
            ->findOneByIdAttributeMotherGridKey($attributeGridValueTransfer->getFkAttributeMotherGridKey());

        $attributeMotherGridColEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridCol()
            ->findOneByIdAttributeMotherGridCol($attributeGridValueTransfer->getFkAttributeMotherGridCol());

        if ($attributeMotherGridKeyEntity->getFkAttributeMotherGrid() !== $attributeMotherGridColEntity->getFkAttributeMotherGrid()) {
            throw new AttributeMotherGridCollisionException("Key and Col should be from the same Attribute Mother Grid");
        }
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
