<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\SizeHarmonization\Business\Manager;

use Generated\Shared\Transfer\AttributeMotherGridTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGrid;

class AttributeMotherGridManager implements AttributeMotherGridManagerInterface
{
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
        // @artem @todo
        $this->productQueryContainer->getConnection()->beginTransaction();

        $idProductAbstract = $this->productAbstractManager->saveProductAbstract($productAbstractTransfer);

        foreach ($productConcreteCollection as $productConcrete) {
            $productConcrete->setFkProductAbstract($idProductAbstract);

            $productConcreteEntity = $this->productConcreteManager->findProductEntityByAbstractAndConcrete(
                $productAbstractTransfer,
                $productConcrete
            );

            if ($productConcreteEntity) {
                $this->productConcreteManager->saveProductConcrete($productConcrete);
            } else {
                $idProductConcrete = $this->productConcreteManager->createProductConcrete($productConcrete);
                $productConcrete->setIdProductConcrete($idProductConcrete);
            }
        }

        $this->productQueryContainer->getConnection()->commit();

        return $idProductAbstract;
    }
}
