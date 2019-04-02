<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider;

use Pyz\Zed\SizeHarmonization\Communication\Form\AttributeGridValueForm;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer;

class AttributeGridValueFormDataProvider
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
     * @param int|null $idAttributeGridValue
     *
     * @return array
     */
    public function getData($idAttributeGridValue = null)
    {
        $formData = [];

        if ($idAttributeGridValue === null) {
            return $formData;
        }

        $attributeGridValueEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeGridValueById($idAttributeGridValue)
            ->findOne();

        $formData = $attributeGridValueEntity->toArray();

        return $formData;
    }

    /**
     * @param int|null $idAttributeGridValue
     *
     * @return mixed
     */
    public function getOptions($idAttributeGridValue = null)
    {
        return [
            AttributeGridValueForm::OPTION_ATTRIBUTE_MOTHER_GRID_KEY_CHOICES => $this->getAttributeMotherGridKeyList(),
            AttributeGridValueForm::OPTION_ATTRIBUTE_MOTHER_GRID_COL_CHOICES => $this->getAttributeMotherGridColList(),
            AttributeGridValueForm::OPTION_ATTRIBUTE_GRID_GROUP_CHOICES => $this->getAttributeGridGroupList(),
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

    /**
     * @return array
     */
    protected function getAttributeGridGroupList()
    {
        $collection = $this->sizeHarmonizationQueryContainer
            ->queryAttributeGridGroup()
            ->find();

        $attributeGridGroupList = [];

        /** @var \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridGroup $attributeGridGroupEntity */
        foreach ($collection->getData() as $attributeGridGroupEntity) {
            $attributeGridGroupList[$attributeGridGroupEntity->getIdAttributeGridGroup()] = $attributeGridGroupEntity->getGroup();
        }

        return $attributeGridGroupList;
    }
}
