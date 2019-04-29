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
        $query = $this->queryAttributeMotherGrid()
            ->filterByIdAttributeMotherGrid($id);

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
        $query = $this->queryAttributeMotherGridKey()
            ->filterByIdAttributeMotherGridKey($id);

        return $query;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridColQuery
     */
    public function queryAttributeMotherGridCol()
    {
        return $this->getFactory()->createAttributeMotherGridColQuery();
    }

    /**
     * @inheritdoc
     *
     * @param int $id
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridColQuery
     */
    public function queryAttributeMotherGridColById($id)
    {
        $query = $this->queryAttributeMotherGridCol()
            ->filterByIdAttributeMotherGridCol($id);

        return $query;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValueQuery
     */
    public function queryAttributeMotherGridValue()
    {
        return $this->getFactory()->createAttributeMotherGridValueQuery();
    }

    /**
     * @inheritdoc
     *
     * @param int $id
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValueQuery
     */
    public function queryAttributeMotherGridValueById($id)
    {
        $query = $this->queryAttributeMotherGridValue()
            ->filterByIdAttributeMotherGridValue($id);

        return $query;
    }

    /**
     * @inheritdoc
     *
     * @param int $idAttributeMotherGrid
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValueQuery
     */
    public function queryAttributeMotherGridValuesByAttributeMotherGrid($idAttributeMotherGrid)
    {
        $query = $this->queryAttributeMotherGridValue()
            ->useMytAttributeMotherGridKeyQuery()
                ->filterByFkAttributeMotherGrid($idAttributeMotherGrid)
            ->endUse()
            ->joinWithMytAttributeMotherGridCol();

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
        $query = $this->queryAttributeGridGroup()
            ->filterByIdAttributeGridGroup($id);

        return $query;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridValueQuery
     */
    public function queryAttributeGridValue()
    {
        return $this->getFactory()->createAttributeGridValueQuery();
    }

    /**
     * @inheritdoc
     *
     * @param int $id
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridValueQuery
     */
    public function queryAttributeGridValueById($id)
    {
        $query = $this->queryAttributeGridValue()
            ->filterByIdAttributeGridValue($id);

        return $query;
    }

    /**
     * @inheritdoc
     *
     * @param int $idAmgKey
     * @param int $idAmgCol
     * @param int $idAgGroup
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridValueQuery
     */
    public function queryAttributeGridValueByKeyAndColAndGroup($idAmgKey, $idAmgCol, $idAgGroup)
    {
        $query = $this->queryAttributeGridValue()
            ->filterByFkAttributeMotherGridKey($idAmgKey)
            ->filterByFkAttributeMotherGridCol($idAmgCol)
            ->filterByFkAttributeGridGroup($idAgGroup);

        return $query;
    }

    /**
     * @inheritdoc
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridProductAbstractQuery
     */
    public function queryAttributeMotherGridProductAbstract()
    {
        return $this->getFactory()
            ->createAttributeMotherGridProductAbstractQuery();
    }

    /**
     * @inheritdoc
     *
     * @param array $productAbstractIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridProductAbstractQuery
     */
    public function queryAttributeMotherGridProductAbstractByProductIds(array $productAbstractIds)
    {
        $query = $this->getFactory()
            ->createAttributeMotherGridProductAbstractQuery()
            ->filterByFkProductAbstract_In($productAbstractIds);

        return $query;
    }
}
