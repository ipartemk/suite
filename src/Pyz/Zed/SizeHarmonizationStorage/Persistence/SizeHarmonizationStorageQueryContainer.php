<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonizationStorage\Persistence;

use Orm\Zed\SizeHarmonization\Persistence\Map\MytAttributeMotherGridKeyTableMap;
use Orm\Zed\SizeHarmonization\Persistence\Map\MytAttributeMotherGridTableMap;
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
     * @param array $attriuteMotherGridKeyIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery
     */
    public function queryAttributeMotherGridIdsByKeyIds(array $attriuteMotherGridKeyIds)
    {
        return $this->getFactory()
            ->getAttributeMotherGridQueryContainer()
            ->queryAttributeMotherGrid()
            ->useMytAttributeMotherGridKeyQuery()
                ->filterByIdAttributeMotherGridKey_In($attriuteMotherGridKeyIds)
            ->endUse()
            ->select(MytAttributeMotherGridTableMap::COL_ID_ATTRIBUTE_MOTHER_GRID);
    }

    /**
     * @param array $attriuteMotherGridColIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery
     */
    public function queryAttributeMotherGridIdsByColIds(array $attriuteMotherGridColIds)
    {
        return $this->getFactory()
            ->getAttributeMotherGridQueryContainer()
            ->queryAttributeMotherGrid()
            ->useMytAttributeMotherGridColQuery()
                ->filterByIdAttributeMotherGridCol_In($attriuteMotherGridColIds)
            ->endUse()
            ->select(MytAttributeMotherGridTableMap::COL_ID_ATTRIBUTE_MOTHER_GRID);
    }

    /**
     * @param array $attriuteMotherGridValueIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValueQuery
     */
    public function queryAttributeMotherGridIdsByValueIds(array $attriuteMotherGridValueIds)
    {
        return $this->getFactory()
            ->getAttributeMotherGridQueryContainer()
            ->queryAttributeMotherGridValue()
            ->joinWithMytAttributeMotherGridKey()
            ->filterByIdAttributeMotherGridValue_In($attriuteMotherGridValueIds)
            ->select(MytAttributeMotherGridKeyTableMap::COL_FK_ATTRIBUTE_MOTHER_GRID);
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
