<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search\Api\Adapter;

use Exception;
use Generated\Shared\Transfer\FactFinderSearchRequestTransfer;
use Generated\Shared\Transfer\FactFinderSearchResponseTransfer;

class FactFinderAdapter implements FactFinderAdapterInterface
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $guzzleClient;

    protected $requestConverter;

    protected $responseConverter;

    /**
     * @param \GuzzleHttp\Client $guzzleClient
     */
    public function __construct(
        $guzzleClient,
        $requestConverter,
        $responseConverter
    ) {
        $this->guzzleClient = $guzzleClient;
        $this->requestConverter = $requestConverter;
        $this->responseConverter = $responseConverter;
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderSearchRequestTransfer $factFinderSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSearchResponseTransfer
     */
    public function request(FactFinderSearchRequestTransfer $factFinderSearchRequestTransfer)
    {
        $searchRequest = $this->requestConverter->convert($factFinderSearchRequestTransfer);
        $response = $this->guzzleClient->post(
            $this->factFinderUrl,
            [
                'searchRequest' => $searchRequest,
                'auth' => [$this->username, $this->password]
            ]
        );

        try {
            $responseTransfer = $this->responseConverter
                ->convert($response);
        } catch (Exception $e) {
            $responseTransfer = new FactFinderSearchResponseTransfer();
        }

        return $responseTransfer;
    }
}
