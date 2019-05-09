<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductManagement\Communication;

use Pyz\Zed\ProductManagement\Communication\Form\DataProvider\ProductFormEditDataProvider;
use Spryker\Zed\ProductManagement\Communication\ProductManagementCommunicationFactory as SprykerProductManagementCommunicationFactory;

/**
 * @method \Spryker\Zed\ProductManagement\Persistence\ProductManagementQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\ProductManagement\ProductManagementConfig getConfig()
 * @method \Spryker\Zed\ProductManagement\Business\ProductManagementFacadeInterface getFacade()
 */
class ProductManagementCommunicationFactory extends SprykerProductManagementCommunicationFactory
{
    /**
     * @return \Spryker\Zed\ProductManagement\Communication\Form\DataProvider\ProductFormEditDataProvider
     */
    public function createProductFormEditDataProvider()
    {
        $currentLocale = $this->getLocaleFacade()->getCurrentLocale();

        return new ProductFormEditDataProvider(
            $this->getCategoryQueryContainer(),
            $this->getQueryContainer(),
            $this->getProductQueryContainer(),
            $this->getStockQueryContainer(),
            $this->getProductFacade(),
            $this->getProductImageFacade(),
            $this->getPriceProductFacade(),
            $this->createLocaleProvider(),
            $currentLocale,
            $this->getProductAttributeCollection(),
            $this->getProductTaxCollection(),
            $this->getConfig()->getImageUrlPrefix(),
            $this->getStore()
        );
    }
}
