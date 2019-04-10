<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonizationStorage\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \Pyz\Zed\SizeHarmonizationStorage\Persistence\SizeHarmonizationStoragePersistenceFactory getFactory()
 */
class SizeHarmonizationStorageQueryContainer extends AbstractQueryContainer implements SizeHarmonizationStorageQueryContainerInterface
{
    /**
     * @param int $attributeMotherGridId
     *
     * @return \Orm\Zed\SizeHarmonizationStorage\Persistence\MytAttributeMotherGridStorageQuery
     */
    public function queryAttributeMotherGridStorageByAttributeMotherGridId($attributeMotherGridId)
    {
        return $this->getFactory()
            ->createAttributeMotherGridStorageQuery()
            ->filterByFkAttributeMotherGrid($attributeMotherGridId);
    }

    /**
     * @param array $attributeMotherGridIds
     *
     * @return \Orm\Zed\SizeHarmonizationStorage\Persistence\MytAttributeMotherGridStorageQuery
     */
    public function queryAttributeMotherGridStorageByAttributeMotherGridIds(array $attributeMotherGridIds)
    {
        return $this->getFactory()
            ->createAttributeMotherGridStorageQuery()
            ->filterByFkAttributeMotherGrid_In($attributeMotherGridIds);
    }

    /**
     * @param array $attriuteMotherGridIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery
     */
    public function queryAttributeMotherGridByIds(array $attriuteMotherGridIds)
    {
        return $this->getFactory()
            ->getAttributeMotherGridQueryContainer()
            ->queryAttributeMotherGrid()
            ->joinWithMytAttributeMotherGridCol()
            ->joinWithMytAttributeMotherGridKey()
            ->filterByIdAttributeMotherGrid_In($attriuteMotherGridIds);
    }

    /**
     * @param int $idAttributeMotherGrid
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValueQuery
     */
    public function queryAttributeMotherGridValuesByAttributeMotherGrid($idAttributeMotherGrid)
    {
        return $this->getFactory()
            ->getAttributeMotherGridQueryContainer()
            ->queryAttributeMotherGridValuesByAttributeMotherGrid($idAttributeMotherGrid);
    }
}
