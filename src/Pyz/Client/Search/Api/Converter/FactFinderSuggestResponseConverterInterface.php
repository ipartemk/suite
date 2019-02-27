<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search\Api\Converter;

use Generated\Shared\Transfer\FactFinderSuggestResponseTransfer;
use Psr\Http\Message\ResponseInterface;

interface FactFinderSuggestResponseConverterInterface
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Generated\Shared\Transfer\FactFinderSuggestResponseTransfer
     */
    public function convert(ResponseInterface $response): FactFinderSuggestResponseTransfer;
}
