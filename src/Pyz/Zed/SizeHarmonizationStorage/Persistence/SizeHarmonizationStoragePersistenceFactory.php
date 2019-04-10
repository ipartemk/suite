<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonizationStorage\Persistence;

use Orm\Zed\SizeHarmonizationStorage\Persistence\MytAttributeMotherGridStorageQuery;
use Pyz\Zed\SizeHarmonizationStorage\SizeHarmonizationStorageDependencyProvider;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Pyz\Zed\SizeHarmonizationStorage\SizeHarmonizationStorageConfig getConfig()
 * @method \Pyz\Zed\SizeHarmonizationStorage\Persistence\SizeHarmonizationStorageQueryContainer getQueryContainer()
 */
class SizeHarmonizationStoragePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Pyz\Zed\SizeHarmonizationStorage\Dependency\QueryContainer\SizeHarmonizationStorageToSizeHarmonizationQueryContainerBridge
     */
    public function getAttributeMotherGridQueryContainer()
    {
        return $this->getProvidedDependency(SizeHarmonizationStorageDependencyProvider::QUERY_CONTAINER_ATTRIBUTE_MOTHER_GRID);
    }

    /**
     * @return \Orm\Zed\SizeHarmonizationStorage\Persistence\MytAttributeMotherGridStorageQuery
     */
    public function createAttributeMotherGridStorageQuery()
    {
        return MytAttributeMotherGridStorageQuery::create();
    }
}
