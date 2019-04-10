<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\SizeHarmonizationStorage\Communication\Plugin\Event\Subscriber;

use Pyz\Zed\SizeHarmonization\Dependency\SizeHarmonizationEvents;
use Pyz\Zed\SizeHarmonizationStorage\Communication\Plugin\Event\Listener\SizeHarmonizationStorageListener;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\SizeHarmonizationStorage\Communication\SizeHarmonizationStorageCommunicationFactory getFactory()
 * @method \Pyz\Zed\SizeHarmonizationStorage\Business\SizeHarmonizationStorageFacadeInterface getFacade()
 * @method \Pyz\Zed\SizeHarmonizationStorage\SizeHarmonizationStorageConfig getConfig()
 * @method \Pyz\Zed\SizeHarmonizationStorage\Persistence\SizeHarmonizationStorageQueryContainerInterface getQueryContainer()
 */
class SizeHarmonizationStorageEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @api
     *
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection)
    {
        $eventCollection
            ->addListenerQueued(SizeHarmonizationEvents::ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_CREATE, new SizeHarmonizationStorageListener())
            ->addListenerQueued(SizeHarmonizationEvents::ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_UPDATE, new SizeHarmonizationStorageListener())
            ->addListenerQueued(SizeHarmonizationEvents::ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_DELETE, new SizeHarmonizationStorageListener())
        ;

        return $eventCollection;
    }
}
