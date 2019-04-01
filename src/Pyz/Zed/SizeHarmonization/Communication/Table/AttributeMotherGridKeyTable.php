<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Table;

use Orm\Zed\SizeHarmonization\Persistence\Map\MytAttributeMotherGridKeyTableMap;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridKey;
use Pyz\Shared\SizeHarmonization\SizeHarmonizationConfig;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainerInterface;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AttributeMotherGridKeyTable extends AbstractTable
{
    public const COL_ID_ATTRIBUTE_MOTHER_GRID_KEY = 'id_attribute_mother_grid_key';
    public const COL_KEY = 'key';
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
            static::COL_ID_ATTRIBUTE_MOTHER_GRID_KEY => 'AMG ID',
            static::COL_KEY => 'Name',
            static::COL_ATTRIBUTE_MOTHER_GRID => 'AMG',
            static::COL_ACTIONS => 'Actions',
        ]);

        $config->setRawColumns([
            static::COL_ACTIONS,
        ]);

        $config->setSearchable([
            MytAttributeMotherGridKeyTableMap::COL_KEY,
        ]);

        $config->setSortable([
            static::COL_ID_ATTRIBUTE_MOTHER_GRID_KEY,
            static::COL_KEY,
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
            ->queryAttributeMotherGridKey();

        $queryResults = $this->runQuery($query, $config, true);

        $collection = [];
        foreach ($queryResults as $attributeMotherGridKeyEntity) {
            $collection[] = $this->generateItem($attributeMotherGridKeyEntity);
        }

        return $collection;
    }

    /**
     * @param \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridKey $attributeMotherGridKeyEntity
     *
     * @return array
     */
    protected function generateItem(MytAttributeMotherGridKey $attributeMotherGridKeyEntity)
    {
        return [
            static::COL_ID_ATTRIBUTE_MOTHER_GRID_KEY => $attributeMotherGridKeyEntity->getIdAttributeMotherGridKey(),
            static::COL_KEY => $attributeMotherGridKeyEntity->getKey(),
            static::COL_ATTRIBUTE_MOTHER_GRID => $attributeMotherGridKeyEntity
                ->getMytAttributeMotherGrid()
                ->getName(),
            static::COL_ACTIONS => implode(' ', $this->createActionColumn($attributeMotherGridKeyEntity)),
        ];
    }

    /**
     * @param \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridKey $attributeMotherGridKeyEntity
     *
     * @return array
     */
    protected function createActionColumn(MytAttributeMotherGridKey $attributeMotherGridKeyEntity)
    {
        $urls = [];

        $urls[] = $this->generateEditButton(
            Url::generate('/size-harmonization/attribute-mother-grid-key/edit', [
                SizeHarmonizationConfig::PARAM_ID_ATTRIBUTE_MOTHER_GRID_KEY => $attributeMotherGridKeyEntity->getIdAttributeMotherGridKey(),
            ]),
            'Edit'
        );

        return $urls;
    }
}
