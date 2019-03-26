<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider;

use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer;

class AttributeMotherGridFormDataProvider
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

        $attributeMotherGridEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridById($idAttributeMotherGrid)
            ->findOne();

        $formData = $attributeMotherGridEntity->toArray();

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
