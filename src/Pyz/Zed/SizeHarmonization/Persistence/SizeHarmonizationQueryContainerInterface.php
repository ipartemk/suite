<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Persistence;

use Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface;

interface SizeHarmonizationQueryContainerInterface extends QueryContainerInterface
{
    /**
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery
     */
    public function queryAttributeMotherGrid();

    /**
     * @param int $id
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery
     */
    public function queryAttributeMotherGridById($id);

    /**
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridKeyQuery
     */
    public function queryAttributeMotherGridKey();

    /**
     * @param int $id
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridKeyQuery
     */
    public function queryAttributeMotherGridKeyById($id);

    /**
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridColQuery
     */
    public function queryAttributeMotherGridCol();

    /**
     * @param int $id
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridColQuery
     */
    public function queryAttributeMotherGridColById($id);

    /**
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValueQuery
     */
    public function queryAttributeMotherGridValue();

    /**
     * @param int $id
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValueQuery
     */
    public function queryAttributeMotherGridValueById($id);

    /**
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridGroupQuery
     */
    public function queryAttributeGridGroup();

    /**
     * @param int $id
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridGroupQuery
     */
    public function queryAttributeGridGroupById($id);

    /**
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridValueQuery
     */
    public function queryAttributeGridValue();

    /**
     * @param int $id
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridValueQuery
     */
    public function queryAttributeGridValueById($id);
}
