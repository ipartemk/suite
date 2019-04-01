<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Table;

use Orm\Zed\SizeHarmonization\Persistence\Map\MytAttributeMotherGridTableMap;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGrid;
use Pyz\Shared\SizeHarmonization\SizeHarmonizationConfig;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainerInterface;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AttributeMotherGridTable extends AbstractTable
{
    public const COL_ID_ATTRIBUTE_MOTHER_GRID = 'id_attribute_mother_grid';
    public const COL_NAME = 'name';
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
            static::COL_ID_ATTRIBUTE_MOTHER_GRID => 'AMG ID',
            static::COL_NAME => 'Name',
            static::COL_ACTIONS => 'Actions',
        ]);

        $config->setRawColumns([
            static::COL_ACTIONS,
        ]);

        $config->setSearchable([
            MytAttributeMotherGridTableMap::COL_NAME,
        ]);

        $config->setSortable([
            static::COL_ID_ATTRIBUTE_MOTHER_GRID,
            static::COL_NAME,
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
            ->queryAttributeMotherGrid();

        $queryResults = $this->runQuery($query, $config, true);

        $collection = [];
        foreach ($queryResults as $attributeMotherGridEntity) {
            $collection[] = $this->generateItem($attributeMotherGridEntity);
        }

        return $collection;
    }

    /**
     * @param \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGrid $attributeMotherGridEntity
     *
     * @return array
     */
    protected function generateItem(MytAttributeMotherGrid $attributeMotherGridEntity)
    {
        return [
            static::COL_ID_ATTRIBUTE_MOTHER_GRID => $attributeMotherGridEntity->getIdAttributeMotherGrid(),
            static::COL_NAME => $attributeMotherGridEntity->getName(),
            static::COL_ACTIONS => implode(' ', $this->createActionColumn($attributeMotherGridEntity)),
        ];
    }

    /**
     * @param \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGrid $attributeMotherGridEntity
     *
     * @return array
     */
    protected function createActionColumn(MytAttributeMotherGrid $attributeMotherGridEntity)
    {
        $urls = [];

        $urls[] = $this->generateEditButton(
            Url::generate('/size-harmonization/attribute-mother-grid/edit', [
                SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_MOTHER_GRID => $attributeMotherGridEntity->getIdAttributeMotherGrid(),
            ]),
            'Edit'
        );

        return $urls;
    }
}
