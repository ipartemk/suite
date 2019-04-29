<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Dependency;

interface SizeHarmonizationEvents
{
    public const ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_CREATE = 'Entity.myt_attribute_mother_grid.create';
    public const ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_UPDATE = 'Entity.myt_attribute_mother_grid.update';
    public const ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_DELETE = 'Entity.myt_attribute_mother_grid.delete';

    public const ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_KEY_CREATE = 'Entity.myt_attribute_mother_grid_key.create';
    public const ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_KEY_UPDATE = 'Entity.myt_attribute_mother_grid_key.update';
    public const ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_KEY_DELETE = 'Entity.myt_attribute_mother_grid_key.delete';

    public const ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_COL_CREATE = 'Entity.myt_attribute_mother_grid_col.create';
    public const ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_COL_UPDATE = 'Entity.myt_attribute_mother_grid_col.update';
    public const ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_COL_DELETE = 'Entity.myt_attribute_mother_grid_col.delete';

    public const ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_VALUE_CREATE = 'Entity.myt_attribute_mother_grid_value.create';
    public const ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_VALUE_UPDATE = 'Entity.myt_attribute_mother_grid_value.update';
    public const ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_VALUE_DELETE = 'Entity.myt_attribute_mother_grid_value.delete';

    public const ENTITY_MYT_ATTRIBUTE_GRID_VALUE_CREATE = 'Entity.myt_attribute_grid_value.create';
    public const ENTITY_MYT_ATTRIBUTE_GRID_VALUE_UPDATE = 'Entity.myt_attribute_grid_value.update';
    public const ENTITY_MYT_ATTRIBUTE_GRID_VALUE_DELETE = 'Entity.myt_attribute_grid_value.delete';

    public const ENTITY_MYT_ATTRIBUTE_GRID_GROUP_CREATE = 'Entity.myt_attribute_grid_group.create';
    public const ENTITY_MYT_ATTRIBUTE_GRID_GROUP_UPDATE = 'Entity.myt_attribute_grid_group.update';
    public const ENTITY_MYT_ATTRIBUTE_GRID_GROUP_DELETE = 'Entity.myt_attribute_grid_group.delete';

    public const ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_PRODUCT_ABSTRACT_CREATE = 'Entity.myt_attribute_mother_grid_product_abstract.create';
    public const ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_PRODUCT_ABSTRACT_UPDATE = 'Entity.myt_attribute_mother_grid_product_abstract.update';
    public const ENTITY_MYT_ATTRIBUTE_MOTHER_GRID_PRODUCT_ABSTRACT_DELETE = 'Entity.myt_attribute_mother_grid_product_abstract.delete';

    public const ENTITY_SPY_PRODUCT_ABSTRACT_CREATE = 'Entity.spy_product_abstract.create';
    public const ENTITY_SPY_PRODUCT_ABSTRACT_UPDATE = 'Entity.spy_product_abstract.update';
    public const ENTITY_SPY_PRODUCT_ABSTRACT_DELETE = 'Entity.spy_product_abstract.delete';
}
