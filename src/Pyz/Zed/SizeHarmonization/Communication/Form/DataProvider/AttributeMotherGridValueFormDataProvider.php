<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider;

use Pyz\Zed\SizeHarmonization\Communication\Form\AttributeMotherGridValueForm;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer;

class AttributeMotherGridValueFormDataProvider
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
     * @param int|null $idAttributeMotherGridValue
     *
     * @return array
     */
    public function getData($idAttributeMotherGridValue = null)
    {
        $formData = [];

        if ($idAttributeMotherGridValue === null) {
            return $formData;
        }

        $attributeMotherGridValueEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridValueById($idAttributeMotherGridValue)
            ->findOne();

        $formData = $attributeMotherGridValueEntity->toArray();

        return $formData;
    }

    /**
     * @param int|null $idAttributeMotherGridValue
     *
     * @return mixed
     */
    public function getOptions($idAttributeMotherGridValue = null)
    {
        return [
            AttributeMotherGridValueForm::OPTION_ATTRIBUTE_MOTHER_GRID_KEY_CHOICES => $this->getAttributeMotherGridKeyList(),
            AttributeMotherGridValueForm::OPTION_ATTRIBUTE_MOTHER_GRID_COL_CHOICES => $this->getAttributeMotherGridColList(),
        ];
    }

    /**
     * @return array
     */
    protected function getAttributeMotherGridKeyList()
    {
        $collection = $this->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridKey()
            ->orderByFkAttributeMotherGrid()
            ->find();

        $attributeMotherGridKeyList = [];

        /** @var \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridKey $attributeMotherGridKeyEntity */
        foreach ($collection->getData() as $attributeMotherGridKeyEntity) {
            $attributeMotherGridKeyList[$attributeMotherGridKeyEntity->getIdAttributeMotherGridKey()] =
                $attributeMotherGridKeyEntity->getMytAttributeMotherGrid()->getName()
                . " - "
                . $attributeMotherGridKeyEntity->getKey();
        }

        return $attributeMotherGridKeyList;
    }

    /**
     * @return array
     */
    protected function getAttributeMotherGridColList()
    {
        $collection = $this->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridCol()
            ->orderByFkAttributeMotherGrid()
            ->find();

        $attributeMotherGridColList = [];

        /** @var \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridCol $attributeMotherGridColEntity */
        foreach ($collection->getData() as $attributeMotherGridColEntity) {
            $attributeMotherGridColList[$attributeMotherGridColEntity->getIdAttributeMotherGridCol()] =
                $attributeMotherGridColEntity->getMytAttributeMotherGrid()->getName()
                . " - "
                . $attributeMotherGridColEntity->getCol();
        }

        return $attributeMotherGridColList;
    }
}
