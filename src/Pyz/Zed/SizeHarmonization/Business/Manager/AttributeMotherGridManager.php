<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Business\Manager;

use Generated\Shared\Transfer\AttributeMotherGridTransfer;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGrid;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer;

class AttributeMotherGridManager
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
     * @param \Generated\Shared\Transfer\AttributeMotherGridTransfer $attributeMotherGridTransfer
     *
     * @return int
     */
    public function addAttributeMotherGrid(AttributeMotherGridTransfer $attributeMotherGridTransfer): int
    {
        $attributeMotherGridEntity = new MytAttributeMotherGrid();
        $attributeMotherGridEntity->fromArray($attributeMotherGridTransfer->toArray());

        $attributeMotherGridEntity->save();

        return $attributeMotherGridEntity->getIdAttributeMotherGrid();
    }

    /**
     * @param \Generated\Shared\Transfer\AttributeMotherGridTransfer $attributeMotherGridTransfer
     *
     * @return bool
     */
    public function updateAttributeMotherGrid(AttributeMotherGridTransfer $attributeMotherGridTransfer): bool
    {
        $attributeMotherGridEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridById($attributeMotherGridTransfer->getIdAttributeMotherGrid())
            ->findOne();

        if (!$attributeMotherGridEntity) {
            return false;
        }

        $attributeMotherGridEntity->fromArray($attributeMotherGridTransfer->toArray());
        $attributeMotherGridEntity->save();

        return true;
    }

    /**
     * @param int $idAttributeMotherGrid
     *
     * @return void
     */
    public function deleteAttributeMotherGrid($idAttributeMotherGrid): void
    {
        $attributeMotherGridEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridById($idAttributeMotherGrid)
            ->findOne();

        if ($attributeMotherGridEntity) {
            $attributeMotherGridEntity->delete();
        }
    }
}
