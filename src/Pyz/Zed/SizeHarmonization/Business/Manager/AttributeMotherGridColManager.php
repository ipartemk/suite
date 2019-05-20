<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Business\Manager;

use Generated\Shared\Transfer\AttributeMotherGridColTransfer;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridCol;
use Pyz\Zed\SizeHarmonization\Business\Exception\AttributeMotherGridCollisionException;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer;

class AttributeMotherGridColManager
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
     * @param \Generated\Shared\Transfer\AttributeMotherGridColTransfer $attributeMotherGridColTransfer
     *
     * @return int
     */
    public function addAttributeMotherGridCol(AttributeMotherGridColTransfer $attributeMotherGridColTransfer): int
    {
        $attributeMotherGridColEntity = new MytAttributeMotherGridCol();
        $attributeMotherGridColEntity->fromArray($attributeMotherGridColTransfer->toArray());

        $attributeMotherGridColEntity->save();

        return $attributeMotherGridColEntity->getIdAttributeMotherGridCol();
    }

    /**
     * @param \Generated\Shared\Transfer\AttributeMotherGridColTransfer $attributeMotherGridColTransfer
     *
     * @return bool
     */
    public function updateAttributeMotherGridCol(AttributeMotherGridColTransfer $attributeMotherGridColTransfer): bool
    {
        $attributeMotherGridColEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridColById($attributeMotherGridColTransfer->getIdAttributeMotherGridCol())
            ->findOne();

        if (!$attributeMotherGridColEntity) {
            return false;
        }

        $this->checkAttributeMotherGridConsistency($attributeMotherGridColEntity, $attributeMotherGridColTransfer);

        $attributeMotherGridColEntity->fromArray($attributeMotherGridColTransfer->toArray());
        $attributeMotherGridColEntity->save();

        return true;
    }

    /**
     * @param \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridCol $attributeMotherGridColEntity
     * @param \Generated\Shared\Transfer\AttributeMotherGridColTransfer $attributeMotherGridColTransfer
     *
     * @throws \Pyz\Zed\SizeHarmonization\Business\Exception\AttributeMotherGridCollisionException
     */
    protected function checkAttributeMotherGridConsistency(
        MytAttributeMotherGridCol $attributeMotherGridColEntity,
        AttributeMotherGridColTransfer $attributeMotherGridColTransfer
    ) {
        foreach ($attributeMotherGridColEntity->getMytAttributeMotherGridValues() as $attributeMotherGridValueEntity) {
            if ($attributeMotherGridValueEntity->getMytAttributeMotherGridKey()->getFkAttributeMotherGrid() !== $attributeMotherGridColTransfer->getFkAttributeMotherGrid()) {
                throw new AttributeMotherGridCollisionException("This Col has values from different Attribute Mother Grid");
            }
        }
    }

    /**
     * @param int $idAttributeMotherGridCol
     *
     * @return void
     */
    public function deleteAttributeMotherGridCol($idAttributeMotherGridCol): void
    {
        $attributeMotherGridColEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridColById($idAttributeMotherGridCol)
            ->findOne();

        if ($attributeMotherGridColEntity) {
            $attributeMotherGridColEntity->delete();
        }
    }
}
