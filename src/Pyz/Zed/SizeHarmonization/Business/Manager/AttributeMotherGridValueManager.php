<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Business\Manager;

use Generated\Shared\Transfer\AttributeMotherGridValueTransfer;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValue;
use Pyz\Zed\SizeHarmonization\Business\Exception\AttributeMotherGridCollisionException;
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
        $this->checkAttributeMotherGridConsistency($attributeMotherGridValueTransfer);

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
        $this->checkAttributeMotherGridConsistency($attributeMotherGridValueTransfer);

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

    /**
     * @param \Generated\Shared\Transfer\AttributeMotherGridValueTransfer $attributeMotherGridValueTransfer
     *
     * @throws \Pyz\Zed\SizeHarmonization\Business\Exception\AttributeMotherGridCollisionException
     */
    protected function checkAttributeMotherGridConsistency(AttributeMotherGridValueTransfer $attributeMotherGridValueTransfer)
    {
        $attributeMotherGridKeyEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridKey()
            ->findOneByIdAttributeMotherGridKey($attributeMotherGridValueTransfer->getFkAttributeMotherGridKey());

        $attributeMotherGridColEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridCol()
            ->findOneByIdAttributeMotherGridCol($attributeMotherGridValueTransfer->getFkAttributeMotherGridCol());

        if ($attributeMotherGridKeyEntity->getFkAttributeMotherGrid() !== $attributeMotherGridColEntity->getFkAttributeMotherGrid()) {
            throw new AttributeMotherGridCollisionException("Key and Col should be from the same Attribute Mother Grid");
        }
    }

    /**
     * @param int $idAttributeMotherGridValue
     *
     * @return void
     */
    public function deleteAttributeMotherGridValue($idAttributeMotherGridValue): void
    {
        $attributeMotherGridValueEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridValueById($idAttributeMotherGridValue)
            ->findOne();

        if ($attributeMotherGridValueEntity) {
            $attributeMotherGridValueEntity->delete();
        }
    }
}
