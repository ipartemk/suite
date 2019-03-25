<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\SizeHarmonization\Plugin\Provider;

use Silex\Application;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\AbstractYvesControllerProvider;

class SizeHarmonizationControllerProvider extends AbstractYvesControllerProvider
{
    public const SIZEHARMONIZATION_INDEX = 'sizeharmonization-index';

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    protected function defineControllers(Application $app)
    {
        $this->createGetController('/size-harmonization', static::SIZEHARMONIZATION_INDEX, 'SizeHarmonization', 'Index', 'index');
    }
}
