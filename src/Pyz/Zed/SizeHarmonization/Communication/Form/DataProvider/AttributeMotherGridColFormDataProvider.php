<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider;

use Pyz\Zed\SizeHarmonization\Communication\Form\AttributeMotherGridColForm;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer;

class AttributeMotherGridColFormDataProvider
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
     * @param int|null $idAttributeMotherGridCol
     *
     * @return array
     */
    public function getData($idAttributeMotherGridCol = null)
    {
        $formData = [];

        if ($idAttributeMotherGridCol === null) {
            return $formData;
        }

        $attributeMotherGridColEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridColById($idAttributeMotherGridCol)
            ->findOne();

        $formData = $attributeMotherGridColEntity->toArray();

        return $formData;
    }

    /**
     * @param int|null $idAttributeMotherGridCol
     *
     * @return mixed
     */
    public function getOptions($idAttributeMotherGridCol = null)
    {
        return [
            AttributeMotherGridColForm::OPTION_ATTRIBUTE_MOTHER_GRID_CHOICES => $this->getAttributeMotherGridList(),
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
