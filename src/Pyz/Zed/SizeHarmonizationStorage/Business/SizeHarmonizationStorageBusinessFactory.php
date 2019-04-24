<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonizationStorage\Business;

use Pyz\Zed\SizeHarmonizationStorage\Business\Storage\AttributeGridStorageWriter;
use Pyz\Zed\SizeHarmonizationStorage\Business\Storage\AttributeMotherGridStorageWriter;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\SizeHarmonizationStorage\SizeHarmonizationStorageConfig getConfig()
 * @method \Pyz\Zed\SizeHarmonizationStorage\Persistence\SizeHarmonizationStorageQueryContainer getQueryContainer()
 */
class SizeHarmonizationStorageBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\SizeHarmonizationStorage\Business\Storage\AttributeMotherGridStorageWriter
     */
    public function createAttributeMotherGridStorageWriter()
    {
        return new AttributeMotherGridStorageWriter(
            $this->getQueryContainer()
        );
    }

    /**
     * @return \Pyz\Zed\SizeHarmonizationStorage\Business\Storage\AttributeGridStorageWriter
     */
    public function createAttributeGridStorageWriter()
    {
        return new AttributeGridStorageWriter(
            $this->getQueryContainer()
        );
    }
}
