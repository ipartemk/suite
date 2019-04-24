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
class AttributeMotherGridColStorageListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    /**
     * @param array $eventTransfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventTransfers, $eventName)
    {
        $messageIds = $this->getFactory()
            ->getEventBehaviorFacade()
            ->getEventTransferIds($eventTransfers);

        $attributeMotherGridIds = $this->getQueryContainer()
            ->queryAttributeMotherGridIdsByColIds($messageIds)
            ->find()
            ->getData();

        if ($eventName === SizeHarmonizationEvents::ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_COL_DELETE) {
            $this->getFacade()->unpublishAttributeMotherGrid($attributeMotherGridIds);
        } elseif ($eventName === SizeHarmonizationEvents::ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_COL_CREATE
            || $eventName === SizeHarmonizationEvents::ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_COL_UPDATE
        ) {
            $this->getFacade()->publishAttributeMotherGrid($attributeMotherGridIds);
        }
    }
}
