<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonizationStorage\Dependency\QueryContainer;

class SizeHarmonizationStorageToSizeHarmonizationQueryContainerBridge
{
    /**
     * @var \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @param \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainerInterface $queryContainer
     */
    public function __construct($queryContainer)
    {
        $this->queryContainer = $queryContainer;
    }

    /**
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery
     */
    public function queryAttributeMotherGrid()
    {
        return $this->queryContainer->queryAttributeMotherGrid();
    }

    /**
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValueQuery
     */
    public function queryAttributeMotherGridValue()
    {
        return $this->queryContainer->queryAttributeMotherGridValue();
    }

    /**
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridValueQuery
     */
    public function queryAttributeGridValue()
    {
        return $this->queryContainer->queryAttributeGridValue();
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
        return $this->queryContainer->queryAttributeGridValueByKeyAndColAndGroup($idAmgKey, $idAmgCol, $idAgGroup);
    }

    /**
     * @param int $idAttributeMotherGrid
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValueQuery
     */
    public function queryAttributeMotherGridValuesByAttributeMotherGrid($idAttributeMotherGrid)
    {
        return $this->queryContainer->queryAttributeMotherGridValuesByAttributeMotherGrid($idAttributeMotherGrid);
    }

    /**
     * @param array $productAbstractIds
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridProductAbstractQuery
     */
    public function queryAttributeMotherGridProductAbstractByProductIds(array $productAbstractIds)
    {
        return $this->queryContainer->queryAttributeMotherGridProductAbstractByProductIds($productAbstractIds);
    }
}
