<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\SizeHarmonization\Business\Manager;

use Generated\Shared\Transfer\AttributeMotherGridTransfer;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGrid;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer;

class AttributeMotherGridManager implements AttributeMotherGridManagerInterface
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
    public function addAttributeMotherGrid(AttributeMotherGridTransfer $attributeMotherGridTransfer):int
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
    public function updateAttributeMotherGrid(AttributeMotherGridTransfer $attributeMotherGridTransfer):bool
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
}
