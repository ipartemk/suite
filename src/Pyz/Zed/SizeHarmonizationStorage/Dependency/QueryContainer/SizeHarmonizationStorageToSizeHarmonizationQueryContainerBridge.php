<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
     * @param int $idAttributeMotherGrid
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValueQuery
     */
    public function queryAttributeMotherGridValuesByAttributeMotherGrid($idAttributeMotherGrid)
    {
        return $this->queryContainer->queryAttributeMotherGridValuesByAttributeMotherGrid($idAttributeMotherGrid);
    }
}
