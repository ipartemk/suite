<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider;

use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer;

class AttributeGridGroupFormDataProvider
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
     * @param int|null $idAttributeGridGroup
     *
     * @return array
     */
    public function getData($idAttributeGridGroup = null)
    {
        $formData = [];

        if ($idAttributeGridGroup === null) {
            return $formData;
        }

        $attributeGridGroupEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeGridGroupById($idAttributeGridGroup)
            ->findOne();

        $formData = $attributeGridGroupEntity->toArray();

        return $formData;
    }

    /**
     * @param int|null $idAttributeGridGroup
     *
     * @return mixed
     */
    public function getOptions($idAttributeGridGroup = null)
    {
        $formOptions = [];

        return $formOptions;
    }
}
