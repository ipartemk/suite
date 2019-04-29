<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonizationStorage\Communication\Plugin\Event\Listener;

use Pyz\Zed\SizeHarmonization\Dependency\SizeHarmonizationEvents;
use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\SizeHarmonizationStorage\Communication\SizeHarmonizationStorageCommunicationFactory getFactory()
 * @method \Pyz\Zed\SizeHarmonizationStorage\Business\SizeHarmonizationStorageFacadeInterface getFacade()
 * @method \Pyz\Zed\SizeHarmonizationStorage\SizeHarmonizationStorageConfig getConfig()
 * @method \Pyz\Zed\SizeHarmonizationStorage\Persistence\SizeHarmonizationStorageQueryContainerInterface getQueryContainer()
 */
class ProductAbstractStorageListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    /**
     * @param array $eventTransfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventTransfers, $eventName)
    {
        $productAbstractIds = $this->getFactory()
            ->getEventBehaviorFacade()
            ->getEventTransferIds($eventTransfers);

        if ($eventName === SizeHarmonizationEvents::ENTITY_SPY_PRODUCT_ABSTRACT_DELETE) {
            $this->getFacade()->unpublishAttributeGrid($productAbstractIds);
        } elseif ($eventName === SizeHarmonizationEvents::ENTITY_SPY_PRODUCT_ABSTRACT_CREATE
            || $eventName === SizeHarmonizationEvents::ENTITY_SPY_PRODUCT_ABSTRACT_UPDATE
        ) {
            $this->getFacade()->publishAttributeGrid($productAbstractIds);
        }
    }
}
