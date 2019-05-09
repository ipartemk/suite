<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Product\Business;

use Pyz\Zed\Product\Business\Product\ProductAbstractManager;
use Spryker\Zed\Product\Business\ProductBusinessFactory as SprykerProductBusinessFactory;

/**
 * @method \Spryker\Zed\Product\ProductConfig getConfig()
 * @method \Spryker\Zed\Product\Persistence\ProductQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Product\Persistence\ProductRepositoryInterface getRepository()
 */
class ProductBusinessFactory extends SprykerProductBusinessFactory
{
    /**
     * @return \Spryker\Zed\Product\Business\Product\ProductAbstractManagerInterface
     */
    public function createProductAbstractManager()
    {
        $productAbstractManager = new ProductAbstractManager(
            $this->getQueryContainer(),
            $this->getTouchFacade(),
            $this->getLocaleFacade(),
            $this->createProductAbstractAssertion(),
            $this->createSkuGenerator(),
            $this->createAttributeEncoder(),
            $this->createProductTransferMapper(),
            $this->createProductAbstractStoreRelationReader(),
            $this->createProductAbstractStoreRelationWriter()
        );

        $productAbstractManager->setEventFacade($this->getEventFacade());

        return $this->attachProductAbstractManagerObservers($productAbstractManager);
    }
}
