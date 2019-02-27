<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search\Api\Adapter;

use Generated\Shared\Transfer\FactFinderSuggestRequestTransfer;
use Generated\Shared\Transfer\FactFinderSuggestResponseTransfer;

interface FactFinderSuggestAdapterInterface
{
    /**
     * @param \Generated\Shared\Transfer\FactFinderSuggestRequestTransfer $factFinderSuggestRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSuggestResponseTransfer
     */
    public function request(FactFinderSuggestRequestTransfer $factFinderSuggestRequestTransfer): FactFinderSuggestResponseTransfer;
}
