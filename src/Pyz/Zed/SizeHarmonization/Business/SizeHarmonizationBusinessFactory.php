<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Business;

use Pyz\Zed\SizeHarmonization\Business\Manager\AttributeMotherGridManager;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\SizeHarmonization\SizeHarmonizationConfig getConfig()
 * @method \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer getQueryContainer()
 */
class SizeHarmonizationBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\SizeHarmonization\Business\Manager\AttributeMotherGridManagerInterface
     */
    public function createAttributeMotherGridManager()
    {
        return new AttributeMotherGridManager(
            $this->getQueryContainer()
        );
    }
}
