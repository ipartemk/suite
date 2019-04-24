<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonizationStorage\Persistence;

use Orm\Zed\SizeHarmonization\Persistence\Map\MytAttributeMotherGridKeyTableMap;
use Orm\Zed\SizeHarmonization\Persistence\Map\MytAttributeMotherGridProductAbstractTableMap;
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
     * @param int $productAbstractId
     *
     * @return \Orm\Zed\SizeHarmonizationStorage\Persistence\MytAttributeGridStorageQuery
     */
    public function queryAttributeGridStorageByProductAbstractId($productAbstractId)
    {
        return $this->getFactory()
            ->createAttributeGridStorageQuery()
            ->filterByFkProductAbstract($productAbstractId);
    }

    /**
     * @param array $productAbstractIds
     *
     * @return \Orm\Zed\SizeHarmonizationStorage\Persistence\MytAttributeGridStorageQuery
     */
    public function queryAttributeGridStorageByProductAbstractIds(array $productAbstractIds)
    {
        return $this->getFactory()
            ->createAttributeGridStorageQuery()
            ->filterByFkProductAbstract_In($productAbstractIds);
    }

    /**
     * @param array $attributeMotherGridIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery
     */
    public function queryAttributeMotherGridByIds(array $attributeMotherGridIds)
    {
        return $this->getFactory()
            ->getSizeHarmonizationQueryContainer()
            ->queryAttributeMotherGrid()
            ->joinWithMytAttributeMotherGridCol()
            ->joinWithMytAttributeMotherGridKey()
            ->filterByIdAttributeMotherGrid_In($attributeMotherGridIds);
    }

    /**
     * @param array $attriuteMotherGridKeyIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery
     */
    public function queryAttributeMotherGridIdsByKeyIds(array $attriuteMotherGridKeyIds)
    {
        return $this->getFactory()
            ->getSizeHarmonizationQueryContainer()
            ->queryAttributeMotherGrid()
            ->useMytAttributeMotherGridKeyQuery()
                ->filterByIdAttributeMotherGridKey_In($attriuteMotherGridKeyIds)
            ->endUse()
            ->select(MytAttributeMotherGridTableMap::COL_ID_ATTRIBUTE_MOTHER_GRID);
    }

    /**
     * @param array $attributeMotherGridColIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery
     */
    public function queryAttributeMotherGridIdsByColIds(array $attributeMotherGridColIds)
    {
        return $this->getFactory()
            ->getSizeHarmonizationQueryContainer()
            ->queryAttributeMotherGrid()
            ->useMytAttributeMotherGridColQuery()
                ->filterByIdAttributeMotherGridCol_In($attributeMotherGridColIds)
            ->endUse()
            ->select(MytAttributeMotherGridTableMap::COL_ID_ATTRIBUTE_MOTHER_GRID);
    }

    /**
     * @param array $attributeMotherGridValueIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValueQuery
     */
    public function queryAttributeMotherGridIdsByAMGValueIds(array $attributeMotherGridValueIds)
    {
        return $this->getFactory()
            ->getSizeHarmonizationQueryContainer()
            ->queryAttributeMotherGridValue()
            ->joinWithMytAttributeMotherGridKey()
            ->filterByIdAttributeMotherGridValue_In($attributeMotherGridValueIds)
            ->select(MytAttributeMotherGridKeyTableMap::COL_FK_ATTRIBUTE_MOTHER_GRID);
    }

    /**
     * @param array $attributeGridValueIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridValueQuery
     */
    public function queryProductAbstractIdsByAGValueIds(array $attributeGridValueIds)
    {
        return $this->getFactory()
            ->getSizeHarmonizationQueryContainer()
            ->queryAttributeGridValue()
            ->useMytAttributeMotherGridKeyQuery()
                ->useMytAttributeMotherGridQuery()
                    ->useMytAttributeMotherGridProductAbstractQuery()
                    ->enduse()
                ->enduse()
            ->enduse()
            ->filterByIdAttributeGridValue_In($attributeGridValueIds)
            ->select(MytAttributeMotherGridProductAbstractTableMap::COL_FK_PRODUCT_ABSTRACT);
    }

    /**
     * @param int $idAmgKey
     * @param int $idAmgCol
     * @param int $idAgGroup
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridValueQuery
     */
    public function queryAttributeGridValueByKeyAndColAndGroup($idAmgKey, $idAmgCol, $idAgGroup)
    {
        return $this->getFactory()
            ->getSizeHarmonizationQueryContainer()
            ->queryAttributeGridValueByKeyAndColAndGroup($idAmgKey, $idAmgCol, $idAgGroup);
    }

    /**
     * @param int $idAttributeMotherGrid
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValueQuery
     */
    public function queryAttributeMotherGridValuesByAttributeMotherGrid($idAttributeMotherGrid)
    {
        return $this->getFactory()
            ->getSizeHarmonizationQueryContainer()
            ->queryAttributeMotherGridValuesByAttributeMotherGrid($idAttributeMotherGrid);
    }

    /**
     * @param array $productAbstractIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridProductAbstractQuery
     */
    public function queryAttributeMotherGridProductAbstractByProductIds(array $productAbstractIds)
    {
        return $this->getFactory()
            ->getSizeHarmonizationQueryContainer()
            ->queryAttributeMotherGridProductAbstractByProductIds($productAbstractIds);
    }
}
