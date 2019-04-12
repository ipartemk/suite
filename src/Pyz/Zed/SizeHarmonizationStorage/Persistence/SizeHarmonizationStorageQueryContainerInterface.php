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
     * @param array $attributeMotherGridId
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
     * @param array $attriuteMotherGridIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery
     */
    public function queryAttributeMotherGridByIds(array $attriuteMotherGridIds);

    /**
     * @param array $attriuteMotherGridKeyIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery
     */
    public function queryAttributeMotherGridIdsByKeyIds(array $attriuteMotherGridKeyIds);

    /**
     * @param array $attriuteMotherGridColIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery
     */
    public function queryAttributeMotherGridIdsByColIds(array $attriuteMotherGridColIds);

    /**
     * @param array $attriuteMotherGridValueIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValueQuery
     */
    public function queryAttributeMotherGridIdsByValueIds(array $attriuteMotherGridValueIds);

    /**
     * @param int $idAttributeMotherGrid
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValueQuery
     */
    public function queryAttributeMotherGridValuesByAttributeMotherGrid($idAttributeMotherGrid);
}
