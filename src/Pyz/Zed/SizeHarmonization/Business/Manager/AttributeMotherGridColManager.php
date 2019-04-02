<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Business\Manager;

use Generated\Shared\Transfer\AttributeMotherGridColTransfer;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridCol;
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
            ->queryAttributeMotherGridKeyById($attributeMotherGridColTransfer->getIdAttributeMotherGridCol())
            ->findOne();

        if (!$attributeMotherGridColEntity) {
            return false;
        }

        $attributeMotherGridColEntity->fromArray($attributeMotherGridColTransfer->toArray());
        $attributeMotherGridColEntity->save();

        return true;
    }
}
