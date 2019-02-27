<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search\Api\Converter;

use Generated\Shared\Transfer\FactFinderSearchRequestTransfer;

interface FactFinderSearchRequestConverterInterface
{
    /**
     * @param \Generated\Shared\Transfer\FactFinderSearchRequestTransfer $factFinderSearchRequestTransfer
     *
     * @return array
     */
    public function convert(FactFinderSearchRequestTransfer $factFinderSearchRequestTransfer): array;
}
