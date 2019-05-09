<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Business\Manager;

use Generated\Shared\Transfer\AttributeGridGroupTransfer;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridGroup;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer;

class AttributeGridGroupManager
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
     * @param \Generated\Shared\Transfer\AttributeGridGroupTransfer $attributeGridGroupTransfer
     *
     * @return int
     */
    public function addAttributeGridGroup(AttributeGridGroupTransfer $attributeGridGroupTransfer): int
    {
        $attributeGridGroupEntity = new MytAttributeGridGroup();
        $attributeGridGroupEntity->fromArray($attributeGridGroupTransfer->toArray());

        $attributeGridGroupEntity->save();

        return $attributeGridGroupEntity->getIdAttributeGridGroup();
    }

    /**
     * @param \Generated\Shared\Transfer\AttributeGridGroupTransfer $attributeGridGroupTransfer
     *
     * @return bool
     */
    public function updateAttributeGridGroup(AttributeGridGroupTransfer $attributeGridGroupTransfer): bool
    {
        $attributeGridGroupEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeGridGroupById($attributeGridGroupTransfer->getIdAttributeGridGroup())
            ->findOne();

        if (!$attributeGridGroupEntity) {
            return false;
        }

        $attributeGridGroupEntity->fromArray($attributeGridGroupTransfer->toArray());
        $attributeGridGroupEntity->save();

        return true;
    }

    /**
     * @param int $idAttributeGridGroup
     *
     * @return void
     */
    public function deleteAttributeGridGroup($idAttributeGridGroup): void
    {
        $attributeGridGroupEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeGridGroupById($idAttributeGridGroup)
            ->findOne();

        if ($attributeGridGroupEntity) {
            $attributeGridGroupEntity->delete();
        }
    }
}
