<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Product\Business\Product;

use Generated\Shared\Transfer\ProductAbstractSizeHarmonizationTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Product\Business\Product\ProductAbstractManager as SprykerProductAbstractManager;

class ProductAbstractManager extends SprykerProductAbstractManager
{
    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer|null
     */
    public function findProductAbstractById($idProductAbstract)
    {
        $productAbstractEntity = $this->productQueryContainer
            ->queryProductAbstract()
            ->filterByIdProductAbstract($idProductAbstract)
            ->findOne();

        if (!$productAbstractEntity) {
            return null;
        }

        $productAbstractTransfer = $this->productTransferMapper->convertProductAbstract($productAbstractEntity);
        $productAbstractTransfer = $this->loadLocalizedAttributes($productAbstractTransfer);
        $productAbstractTransfer->setStoreRelation(
            $this->getStoreRelation($idProductAbstract)
        );

        $productAbstractTransfer = $this->notifyReadObservers($productAbstractTransfer);

        if ($productAbstractEntity->getFkAttributeGridGroup()) {
            $sizeHarmonizationTransfer = new ProductAbstractSizeHarmonizationTransfer();
            $sizeHarmonizationTransfer->setFkAttributeGridGroup($productAbstractEntity->getFkAttributeGridGroup());

            $productAbstractTransfer->setSizeHarmonization($sizeHarmonizationTransfer);
        }

        return $productAbstractTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstract
     */
    protected function persistEntity(ProductAbstractTransfer $productAbstractTransfer)
    {
        $jsonAttributes = $this->attributeEncoder->encodeAttributes(
            $productAbstractTransfer->getAttributes()
        );

        $productAbstractEntity = $this->productQueryContainer
            ->queryProductAbstract()
            ->filterByIdProductAbstract($productAbstractTransfer->getIdProductAbstract())
            ->findOneOrCreate();

        $productAbstractData = $productAbstractTransfer->modifiedToArray();
        if (isset($productAbstractData[ProductAbstractTransfer::ATTRIBUTES])) {
            unset($productAbstractData[ProductAbstractTransfer::ATTRIBUTES]);
        }

        $productAbstractEntity->fromArray($productAbstractData);
        $productAbstractEntity->setAttributes($jsonAttributes);

        if ($productAbstractTransfer->getSizeHarmonization()
            && $productAbstractTransfer->getSizeHarmonization()->getFkAttributeGridGroup()
        ) {
            $productAbstractEntity->setFkAttributeGridGroup(
                $productAbstractTransfer->getSizeHarmonization()->getFkAttributeGridGroup()
            );
        }

        $productAbstractEntity->save();

        return $productAbstractEntity;
    }
}
