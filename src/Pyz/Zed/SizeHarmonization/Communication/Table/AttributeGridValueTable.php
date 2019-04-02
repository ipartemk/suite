<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Table;

use Orm\Zed\SizeHarmonization\Persistence\Map\MytAttributeMotherGridValueTableMap;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridValue;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridValue;
use Pyz\Shared\SizeHarmonization\SizeHarmonizationConfig;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainerInterface;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AttributeGridValueTable extends AbstractTable
{
    public const COL_ID_ATTRIBUTE_GRID_VALUE = 'id_attribute_grid_value';
    public const COL_VALUE = 'value';
    public const COL_ATTRIBUTE_MOTHER_GRID_KEY = 'attribute_mother_grid_key';
    public const COL_ATTRIBUTE_MOTHER_GRID_COL = 'attribute_mother_grid_col';
    public const COL_ATTRIBUTE_GRID_GROUP = 'attribute_grid_group';
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
            static::COL_ID_ATTRIBUTE_GRID_VALUE => 'AG Value ID',
            static::COL_ATTRIBUTE_MOTHER_GRID_KEY => 'AMG Key',
            static::COL_ATTRIBUTE_MOTHER_GRID_COL => 'AMG Col',
            static::COL_VALUE => 'Value',
            static::COL_ATTRIBUTE_GRID_GROUP => 'AG Group',
            static::COL_ACTIONS => 'Actions',
        ]);

        $config->setRawColumns([
            static::COL_ACTIONS,
        ]);

        $config->setSearchable([
            MytAttributeMotherGridValueTableMap::COL_VALUE,
        ]);

        $config->setSortable([
            static::COL_ID_ATTRIBUTE_GRID_VALUE,
            static::COL_VALUE,
            static::COL_ATTRIBUTE_MOTHER_GRID_KEY,
            static::COL_ATTRIBUTE_MOTHER_GRID_COL,
            static::COL_ATTRIBUTE_GRID_GROUP,
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
            ->queryAttributeGridValue();

        $queryResults = $this->runQuery($query, $config, true);

        $collection = [];
        foreach ($queryResults as $attributeGridValueEntity) {
            $collection[] = $this->generateItem($attributeGridValueEntity);
        }

        return $collection;
    }

    /**
     * @param \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridValue $attributeGridValueEntity
     *
     * @return array
     */
    protected function generateItem(MytAttributeGridValue $attributeGridValueEntity)
    {
        $attributeMotherGridKeyEntity = $attributeGridValueEntity->getMytAttributeMotherGridKey();
        $key = $attributeMotherGridKeyEntity->getMytAttributeMotherGrid()->getName()
            . " - "
            . $attributeMotherGridKeyEntity->getKey();

        $attributeMotherGridColEntity = $attributeGridValueEntity->getMytAttributeMotherGridCol();
        $col = $attributeMotherGridColEntity->getMytAttributeMotherGrid()->getName()
            . " - "
            . $attributeMotherGridColEntity->getCol();

        return [
            static::COL_ID_ATTRIBUTE_GRID_VALUE => $attributeGridValueEntity->getIdAttributeGridValue(),
            static::COL_ATTRIBUTE_MOTHER_GRID_KEY => $key,
            static::COL_ATTRIBUTE_MOTHER_GRID_COL => $col,
            static::COL_VALUE => $attributeGridValueEntity->getValue(),
            static::COL_ATTRIBUTE_GRID_GROUP => $attributeGridValueEntity->getMytAttributeGridGroup()->getGroup(),
            static::COL_ACTIONS => implode(' ', $this->createActionColumn($attributeGridValueEntity)),
        ];
    }

    /**
     * @param \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridValue $attributeGridValueEntity
     *
     * @return array
     */
    protected function createActionColumn(MytAttributeGridValue $attributeGridValueEntity)
    {
        $urls = [];

        $urls[] = $this->generateEditButton(
            Url::generate('/size-harmonization/attribute-grid-value/edit', [
                SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_GRID_VALUE => $attributeGridValueEntity->getIdAttributeGridValue(),
            ]),
            'Edit'
        );

        return $urls;
    }
}
