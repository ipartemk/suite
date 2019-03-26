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
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridGroupQuery
     */
    public function queryAttributeGridGroup();

    /**
     * @param int $id
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridGroupQuery
     */
    public function queryAttributeGridGroupById($id);
}
