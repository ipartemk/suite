<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonizationStorage\Persistence;

use Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface;

interface SizeHarmonizationStorageQueryContainerInterface extends QueryContainerInterface
{
    /**
     * @param int $attributeMotherGridId
     *
     * @return \Orm\Zed\SizeHarmonizationStorage\Persistence\MytAttributeMotherGridStorageQuery
     */
    public function queryAttributeMotherGridStorageByAttributeMotherGridId($attributeMotherGridId);

    /**
     * @param array $attributeMotherGridIds
     *
     * @return \Orm\Zed\SizeHarmonizationStorage\Persistence\MytAttributeMotherGridStorageQuery
     */
    public function queryAttributeMotherGridStorageByAttributeMotherGridIds(array $attributeMotherGridIds);

    /**
     * @param int $productAbstractId
     *
     * @return \Orm\Zed\SizeHarmonizationStorage\Persistence\MytAttributeGridStorageQuery
     */
    public function queryAttributeGridStorageByProductAbstractId($productAbstractId);

    /**
     * @param array $productAbstractIds
     *
     * @return \Orm\Zed\SizeHarmonizationStorage\Persistence\MytAttributeGridStorageQuery
     */
    public function queryAttributeGridStorageByProductAbstractIds(array $productAbstractIds);

    /**
     * @param array $attributeMotherGridIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery
     */
    public function queryAttributeMotherGridByIds(array $attributeMotherGridIds);

    /**
     * @param array $attriuteMotherGridKeyIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery
     */
    public function queryAttributeMotherGridIdsByKeyIds(array $attriuteMotherGridKeyIds);

    /**
     * @param array $attributeMotherGridColIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery
     */
    public function queryAttributeMotherGridIdsByColIds(array $attributeMotherGridColIds);

    /**
     * @param array $attributeMotherGridValueIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValueQuery
     */
    public function queryAttributeMotherGridIdsByAMGValueIds(array $attributeMotherGridValueIds);

    /**
     * @param array $attributeGridValueIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridValueQuery
     */
    public function queryProductAbstractIdsByAGValueIds(array $attributeGridValueIds);

    /**
     * @param int $idAmgKey
     * @param int $idAmgCol
     * @param int $idAgGroup
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridValueQuery
     */
    public function queryAttributeGridValueByKeyAndColAndGroup($idAmgKey, $idAmgCol, $idAgGroup);

    /**
     * @param int $idAttributeMotherGrid
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValueQuery
     */
    public function queryAttributeMotherGridValuesByAttributeMotherGrid($idAttributeMotherGrid);

    /**
     * @param array $productAbstractIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridProductAbstractQuery
     */
    public function queryAttributeMotherGridProductAbstractByProductIds(array $productAbstractIds);
}
