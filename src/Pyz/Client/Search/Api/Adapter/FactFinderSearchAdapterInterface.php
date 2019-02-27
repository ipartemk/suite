<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search\Api\Adapter;

use Generated\Shared\Transfer\FactFinderSearchRequestTransfer;
use Generated\Shared\Transfer\FactFinderSearchResponseTransfer;

interface FactFinderSearchAdapterInterface
{
    /**
     * @param \Generated\Shared\Transfer\FactFinderSearchRequestTransfer $factFinderSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSearchResponseTransfer
     */
    public function request(FactFinderSearchRequestTransfer $factFinderSearchRequestTransfer): FactFinderSearchResponseTransfer;
}
