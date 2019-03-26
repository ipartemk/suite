<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider;

use Pyz\Zed\SizeHarmonization\Communication\Form\AttributeMotherGridKeyForm;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer;

class AttributeMotherGridKeyFormDataProvider
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
     * @param int|null $idAttributeMotherGridKey
     *
     * @return array
     */
    public function getData($idAttributeMotherGridKey = null)
    {
        $formData = [];

        if ($idAttributeMotherGridKey === null) {
            return $formData;
        }

        $attributeMotherGridEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridKeyById($idAttributeMotherGridKey)
            ->findOne();

        $formData = $attributeMotherGridEntity->toArray();

        return $formData;
    }

    /**
     * @param int|null $idAttributeMotherGridKey
     *
     * @return mixed
     */
    public function getOptions($idAttributeMotherGridKey = null)
    {
        return [
            AttributeMotherGridKeyForm::OPTION_ATTRIBUTE_MOTHER_GRID_CHOICES => $this->getAttributeMotherGridList(),
        ];
    }

    /**
     * @return array
     */
    protected function getAttributeMotherGridList()
    {
        $collection = $this->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGrid()
            ->find();

        $attributeMotherGridList = [];

        /** @var \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGrid $attributeMotherGridEntity */
        foreach ($collection->getData() as $attributeMotherGridEntity) {
            $attributeMotherGridList[$attributeMotherGridEntity->getIdAttributeMotherGrid()] = $attributeMotherGridEntity->getName();
        }

        return $attributeMotherGridList;
    }
}
