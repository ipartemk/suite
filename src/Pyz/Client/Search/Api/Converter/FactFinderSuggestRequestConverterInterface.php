<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search\Api\Converter;

use Generated\Shared\Transfer\FactFinderSuggestRequestTransfer;

interface FactFinderSuggestRequestConverterInterface
{
    /**
     * @param \Generated\Shared\Transfer\FactFinderSuggestRequestTransfer $factFinderSuggestRequestTransfer
     *
     * @return array
     */
    public function convert(FactFinderSuggestRequestTransfer $factFinderSuggestRequestTransfer): array;
}
