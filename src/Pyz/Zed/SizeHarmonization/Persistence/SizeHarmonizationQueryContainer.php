<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationPersistenceFactory getFactory()
 */
class SizeHarmonizationQueryContainer extends AbstractQueryContainer implements SizeHarmonizationQueryContainerInterface
{
    /**
     * {@inheritdoc}
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery
     */
    public function queryAttributeMotherGrid()
    {
        return $this->getFactory()->createAttributeMotherGridQuery();
    }

    /**
     * @inheritdoc
     *
     * @param int $id
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery
     */
    public function queryAttributeMotherGridById($id)
    {
        $query = $this->queryAttributeMotherGrid();
        $query->filterByIdAttributeMotherGrid($id);

        return $query;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridKeyQuery
     */
    public function queryAttributeMotherGridKey()
    {
        return $this->getFactory()->createAttributeMotherGridKeyQuery();
    }

    /**
     * @inheritdoc
     *
     * @param int $id
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridKeyQuery
     */
    public function queryAttributeMotherGridKeyById($id)
    {
        $query = $this->queryAttributeMotherGridKey();
        $query->filterByIdAttributeMotherGridKey($id);

        return $query;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridGroupQuery
     */
    public function queryAttributeGridGroup()
    {
        return $this->getFactory()->createAttributeGridGroupQuery();
    }

    /**
     * @inheritdoc
     *
     * @param int $id
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridGroupQuery
     */
    public function queryAttributeGridGroupById($id)
    {
        $query = $this->queryAttributeGridGroup();
        $query->filterByIdAttributeGridGroup($id);

        return $query;
    }
}
