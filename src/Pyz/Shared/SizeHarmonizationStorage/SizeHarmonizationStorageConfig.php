<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Shared\SizeHarmonizationStorage;

class SizeHarmonizationStorageConfig
{
    /**
     * Queue name
     */
    public const ATTRIBUTE_MOTHER_GRID_SYNC_STORAGE_QUEUE = 'sync.storage.attribute_mother_grid';

    /**
     * Queue name error messages
     */
    public const ATTRIBUTE_MOTHER_GRID_SYNC_STORAGE_ERROR_QUEUE = 'sync.storage.attribute_mother_grid.error';

    /**
     * Resource name, this will use for key generating
     */
    public const ATTRIBUTE_MOTHER_GRID_RESOURCE_NAME = 'attribute_mother_grid';
}
