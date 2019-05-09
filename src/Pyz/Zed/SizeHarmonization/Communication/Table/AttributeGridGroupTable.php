<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Table;

use Orm\Zed\SizeHarmonization\Persistence\Map\MytAttributeGridGroupTableMap;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridGroup;
use Pyz\Shared\SizeHarmonization\SizeHarmonizationConfig;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainerInterface;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AttributeGridGroupTable extends AbstractTable
{
    public const COL_ID_ATTRIBUTE_GRID_GROUP = 'id_attribute_grid_group';
    public const COL_GROUP = 'group';
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
            static::COL_ID_ATTRIBUTE_GRID_GROUP => 'Attribute Grid Group',
            static::COL_GROUP => 'Group',
            static::COL_ACTIONS => 'Actions',
        ]);

        $config->setRawColumns([
            static::COL_ACTIONS,
        ]);

        $config->setSearchable([
            MytAttributeGridGroupTableMap::COL_GROUP,
        ]);

        $config->setSortable([
            static::COL_ID_ATTRIBUTE_GRID_GROUP,
            static::COL_GROUP,
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
            ->queryAttributeGridGroup();

        $queryResults = $this->runQuery($query, $config, true);

        $productAbstractCollection = [];
        foreach ($queryResults as $attributeGridGroupEntity) {
            $productAbstractCollection[] = $this->generateItem($attributeGridGroupEntity);
        }

        return $productAbstractCollection;
    }

    /**
     * @param \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridGroup $attributeGridGroupEntity
     *
     * @return array
     */
    protected function generateItem(MytAttributeGridGroup $attributeGridGroupEntity)
    {
        return [
            static::COL_ID_ATTRIBUTE_GRID_GROUP => $attributeGridGroupEntity->getIdAttributeGridGroup(),
            static::COL_GROUP => $attributeGridGroupEntity->getGroup(),
            static::COL_ACTIONS => implode(' ', $this->createActionColumn($attributeGridGroupEntity)),
        ];
    }

    /**
     * @param \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridGroup $attributeGridGroupEntity
     *
     * @return array
     */
    protected function createActionColumn(MytAttributeGridGroup $attributeGridGroupEntity)
    {
        $urls = [];

        $urls[] = $this->generateEditButton(
            Url::generate('/size-harmonization/attribute-grid-group/edit', [
                SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_GRID_GROUP => $attributeGridGroupEntity->getIdAttributeGridGroup(),
            ]),
            'Edit'
        );

        $urls[] = $this->generateRemoveButton(
            Url::generate('/size-harmonization/attribute-grid-group/delete', [
                SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_GRID_GROUP => $attributeGridGroupEntity->getIdAttributeGridGroup(),
            ]),
            'Delete'
        );

        return $urls;
    }
}
