<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Table;

use Orm\Zed\SizeHarmonization\Persistence\Map\MytAttributeMotherGridColTableMap;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridCol;
use Pyz\Shared\SizeHarmonization\SizeHarmonizationConfig;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainerInterface;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AttributeMotherGridColTable extends AbstractTable
{
    public const COL_ID_ATTRIBUTE_MOTHER_GRID_COL = 'id_attribute_mother_grid_col';
    public const COL_COL = 'col';
    public const COL_ATTRIBUTE_MOTHER_GRID = 'attribute_mother_grid';
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
            static::COL_ID_ATTRIBUTE_MOTHER_GRID_COL => 'AMG ID',
            static::COL_COL => 'Col',
            static::COL_ATTRIBUTE_MOTHER_GRID => 'AMG',
            static::COL_ACTIONS => 'Actions',
        ]);

        $config->setRawColumns([
            static::COL_ACTIONS,
        ]);

        $config->setSearchable([
            MytAttributeMotherGridColTableMap::COL_COL,
        ]);

        $config->setSortable([
            static::COL_ID_ATTRIBUTE_MOTHER_GRID_COL,
            static::COL_COL,
            static::COL_ATTRIBUTE_MOTHER_GRID,
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
            ->queryAttributeMotherGridCol();

        $queryResults = $this->runQuery($query, $config, true);

        $collection = [];
        foreach ($queryResults as $attributeMotherGridColEntity) {
            $collection[] = $this->generateItem($attributeMotherGridColEntity);
        }

        return $collection;
    }

    /**
     * @param \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridCol $attributeMotherGridColEntity
     *
     * @return array
     */
    protected function generateItem(MytAttributeMotherGridCol $attributeMotherGridColEntity)
    {
        return [
            static::COL_ID_ATTRIBUTE_MOTHER_GRID_COL => $attributeMotherGridColEntity->getIdAttributeMotherGridCol(),
            static::COL_COL => $attributeMotherGridColEntity->getCol(),
            static::COL_ATTRIBUTE_MOTHER_GRID => $attributeMotherGridColEntity
                ->getMytAttributeMotherGrid()
                ->getName(),
            static::COL_ACTIONS => implode(' ', $this->createActionColumn($attributeMotherGridColEntity)),
        ];
    }

    /**
     * @param \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridCol $attributeMotherGridColEntity
     *
     * @return array
     */
    protected function createActionColumn(MytAttributeMotherGridCol $attributeMotherGridColEntity)
    {
        $urls = [];

        $urls[] = $this->generateEditButton(
            Url::generate('/size-harmonization/attribute-mother-grid-col/edit', [
                SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_MOTHER_GRID_COL => $attributeMotherGridColEntity->getIdAttributeMotherGridCol(),
            ]),
            'Edit'
        );

        $urls[] = $this->generateRemoveButton(
            Url::generate('/size-harmonization/attribute-mother-grid-col/delete', [
                SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_MOTHER_GRID_COL => $attributeMotherGridColEntity->getIdAttributeMotherGridCol(),
            ]),
            'Delete'
        );

        return $urls;
    }
}
