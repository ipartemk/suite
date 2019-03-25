<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider;

use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer;

class AttributeMotherGridFormAddDataProvider
{
    /**
     * @var \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer
     */
    protected $sizeHarmonizationQueryContainer;

    /**
     * @param \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer $sizeHarmonizationQueryContainer
     */
    public function __construct(
        SizeHarmonizationQueryContainer $sizeHarmonizationQueryContainer
    ) {
        $this->sizeHarmonizationQueryContainer = $sizeHarmonizationQueryContainer;
    }

    /**
     * @param int|null $idAttributeMotherGrid
     *
     * @return array
     */
    public function getData($idAttributeMotherGrid = null)
    {
        $formData = [];

        if ($idAttributeMotherGrid === null) {
            return $formData;
        }

        $customerEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridById($idAttributeMotherGrid)
            ->findOne();

        $formData = $customerEntity->toArray();

        return $formData;
    }

    /**
     * @param int|null $idAttributeMotherGrid
     *
     * @return mixed
     */
    public function getOptions($idAttributeMotherGrid = null)
    {
        $formOptions = [];

        return $formOptions;
    }
}
