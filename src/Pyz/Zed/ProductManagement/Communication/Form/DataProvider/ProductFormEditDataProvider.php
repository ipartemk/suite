<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductManagement\Communication\Form\DataProvider;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Pyz\Zed\SizeHarmonization\Communication\Form\ProductAbstractSizeHarmonizationForm;
use Pyz\Zed\SizeHarmonization\Communication\Plugin\ProductManagement\SizeHarmonizationProductAbstractFormExpanderPlugin;
use Spryker\Zed\ProductManagement\Communication\Form\DataProvider\ProductFormEditDataProvider as SprykerProductFormEditDataProvider;
use Spryker\Zed\ProductManagement\Communication\Form\ProductFormAdd;

class ProductFormEditDataProvider extends SprykerProductFormEditDataProvider
{
    /**
     * @param int $idProductAbstract
     * @param array|null $priceDimension
     *
     * @return array
     */
    public function getData($idProductAbstract, ?array $priceDimension = null)
    {
        $formData = $this->getDefaultFormFields($priceDimension);
        $productAbstractTransfer = $this->productFacade->findProductAbstractById($idProductAbstract);

        if ($productAbstractTransfer) {
            $formData = $this->appendGeneralAndSeoData($productAbstractTransfer, $formData);
            $formData = $this->appendPriceAndTax($productAbstractTransfer, $formData);
            $formData = $this->appendAbstractProductImages($productAbstractTransfer, $formData);
            $formData = $this->appendStoreRelation($productAbstractTransfer, $formData);

            $formData = $this->appendSizeHarmonization($productAbstractTransfer, $formData);

            $formData[ProductFormAdd::FIELD_ID_PRODUCT_ABSTRACT] = $productAbstractTransfer->getIdProductAbstract();
        }

        return $formData;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     * @param array $formData
     *
     * @return array
     */
    protected function appendSizeHarmonization(ProductAbstractTransfer $productAbstractTransfer, array $formData): array
    {
        if ($productAbstractTransfer->getSizeHarmonization()
            && $productAbstractTransfer->getSizeHarmonization()->getFkAttributeGridGroup()
        ) {
            $formData[SizeHarmonizationProductAbstractFormExpanderPlugin::FORM_SIZE_HARMONIZATION] = [
                ProductAbstractSizeHarmonizationForm::FIELD_ATTRIBUTE_GRID_GROUP => $productAbstractTransfer->getSizeHarmonization()->getFkAttributeGridGroup(),
            ];
        }

        return $formData;
    }
}
