<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search\Api\Request;

use Generated\Shared\Transfer\FactFinderSearchRequestTransfer;

interface FactFinderSearchRequestInterface
{
    /**
     * @param \Generated\Shared\Transfer\FactFinderSearchRequestTransfer $factFinderSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSearchResponseTransfer
     */
    public function request(FactFinderSearchRequestTransfer $factFinderSearchRequestTransfer);
}
