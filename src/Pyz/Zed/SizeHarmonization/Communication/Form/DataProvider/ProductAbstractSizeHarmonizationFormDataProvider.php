<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider;

use Pyz\Zed\SizeHarmonization\Communication\Form\ProductAbstractSizeHarmonizationForm;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer;

class ProductAbstractSizeHarmonizationFormDataProvider
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
     * @param int|null $idProductAbstract
     *
     * @return mixed
     */
    public function getOptions($idProductAbstract = null)
    {
        return [
            ProductAbstractSizeHarmonizationForm::OPTION_ATTRIBUTE_GRID_GROUP_CHOICES => $this->getAttributeGridGroupList(),
        ];
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
