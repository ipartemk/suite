<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Table;

use Orm\Zed\SizeHarmonization\Persistence\Map\MytAttributeMotherGridValueTableMap;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValue;
use Pyz\Shared\SizeHarmonization\SizeHarmonizationConfig;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainerInterface;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AttributeMotherGridValueTable extends AbstractTable
{
    public const COL_ID_ATTRIBUTE_MOTHER_GRID_VALUE = 'id_attribute_mother_grid_value';
    public const COL_VALUE = 'value';
    public const COL_ATTRIBUTE_MOTHER_GRID_KEY = 'attribute_mother_grid_key';
    public const COL_ACTIONS = 'actions';

    /**
     * @var \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainerInterface
     */
    protected $sizeHarmonizationQueryContainer;

    /**
     * @param \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainerInterface $sizeHarmonizationQueryContainer
     */
    public function __construct(
        SizeHarmonizationQueryContainerInterface $sizeHarmonizationQueryContainer
    ) {
        $this->sizeHarmonizationQueryContainer = $sizeHarmonizationQueryContainer;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return mixed
     */
    protected function configure(TableConfiguration $config)
    {
        $config->setHeader([
            static::COL_ID_ATTRIBUTE_MOTHER_GRID_VALUE => 'AMG Value ID',
            static::COL_VALUE => 'Value',
            static::COL_ATTRIBUTE_MOTHER_GRID_KEY => 'AMG Key',
            static::COL_ACTIONS => 'Actions',
        ]);

        $config->setRawColumns([
            static::COL_ACTIONS,
        ]);

        $config->setSearchable([
            MytAttributeMotherGridValueTableMap::COL_VALUE,
        ]);

        $config->setSortable([
            static::COL_ID_ATTRIBUTE_MOTHER_GRID_VALUE,
            static::COL_VALUE,
            static::COL_ATTRIBUTE_MOTHER_GRID_KEY,
        ]);

        $config->setDefaultSortDirection(TableConfiguration::SORT_ASC);

        return $config;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return mixed
     */
    protected function prepareData(TableConfiguration $config)
    {
        $query = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridValue();

        $queryResults = $this->runQuery($query, $config, true);

        $productAbstractCollection = [];
        foreach ($queryResults as $attributeMotherGridValueEntity) {
            $productAbstractCollection[] = $this->generateItem($attributeMotherGridValueEntity);
        }

        return $productAbstractCollection;
    }

    /**
     * @param \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValue $attributeMotherGridValueEntity
     *
     * @return array
     */
    protected function generateItem(MytAttributeMotherGridValue $attributeMotherGridValueEntity)
    {
        $attributeMotherGridKeyEntity = $attributeMotherGridValueEntity->getMytAttributeMotherGridKey();
        $key = $attributeMotherGridKeyEntity->getMytAttributeMotherGrid()->getName()
            . " - "
            . $attributeMotherGridKeyEntity->getKey();
        return [
            static::COL_ID_ATTRIBUTE_MOTHER_GRID_VALUE => $attributeMotherGridValueEntity->getIdAttributeMotherGridValue(),
            static::COL_VALUE => $attributeMotherGridValueEntity->getValue(),
            static::COL_ATTRIBUTE_MOTHER_GRID_KEY => $key,
            static::COL_ACTIONS => implode(' ', $this->createActionColumn($attributeMotherGridValueEntity)),
        ];
    }

    /**
     * @param \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValue $attributeMotherGridValueEntity
     *
     * @return array
     */
    protected function createActionColumn(MytAttributeMotherGridValue $attributeMotherGridValueEntity)
    {
        $urls = [];

        $urls[] = $this->generateEditButton(
            Url::generate('/size-harmonization/attribute-mother-grid-value/edit', [
                SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_MOTHER_GRID_VALUE => $attributeMotherGridValueEntity->getIdAttributeMotherGridValue(),
            ]),
            'Edit'
        );

        return $urls;
    }
}
