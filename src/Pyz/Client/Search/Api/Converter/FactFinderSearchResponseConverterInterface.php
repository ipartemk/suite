<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search\Api\Converter;

use Generated\Shared\Transfer\FactFinderSearchResponseTransfer;
use Psr\Http\Message\ResponseInterface;

interface FactFinderSearchResponseConverterInterface
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Generated\Shared\Transfer\FactFinderSearchResponseTransfer
     */
    public function convert(ResponseInterface $response): FactFinderSearchResponseTransfer;
}
