<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Persistence;

use Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridGroupQuery;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridKeyQuery;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Pyz\Zed\SizeHarmonization\SizeHarmonizationConfig getConfig()
 * @method \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer getQueryContainer()
 */
class SizeHarmonizationPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridQuery
     */
    public function createAttributeMotherGridQuery()
    {
        return MytAttributeMotherGridQuery::create();
    }

    /**
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridKeyQuery
     */
    public function createAttributeMotherGridKeyQuery()
    {
        return MytAttributeMotherGridKeyQuery::create();
    }

    /**
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridGroupQuery
     */
    public function createAttributeGridGroupQuery()
    {
        return MytAttributeGridGroupQuery::create();
    }
}
