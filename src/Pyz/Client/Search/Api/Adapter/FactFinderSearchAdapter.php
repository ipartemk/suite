<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search\Api\Adapter;

use Exception;
use Generated\Shared\Transfer\FactFinderSearchRequestTransfer;
use Generated\Shared\Transfer\FactFinderSearchResponseTransfer;
use GuzzleHttp\Client;
use Pyz\Client\Search\Api\Converter\FactFinderSearchRequestConverterInterface;
use Pyz\Client\Search\Api\Converter\FactFinderSearchResponseConverterInterface;
use Pyz\Client\Search\SearchConfig;

class FactFinderSearchAdapter implements FactFinderSearchAdapterInterface
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $guzzleClient;

    /**
     * @var \Pyz\Client\Search\Api\Converter\FactFinderSearchRequestConverterInterface
     */
    protected $factFinderRequestConverter;

    /**
     * @var \Pyz\Client\Search\Api\Converter\FactFinderSearchResponseConverterInterface
     */
    protected $factFinderResponseConverter;

    /**
     * @var \Pyz\Client\Search\SearchConfig
     */
    protected $searchConfig;

    /**
     * @param \GuzzleHttp\Client $guzzleClient
     * @param \Pyz\Client\Search\Api\Converter\FactFinderSearchRequestConverterInterface $factFinderRequestConverter
     * @param \Pyz\Client\Search\Api\Converter\FactFinderSearchResponseConverterInterface $factFinderResponseConverter
     * @param \Pyz\Client\Search\SearchConfig $searchConfig
     */
    public function __construct(
        Client $guzzleClient,
        FactFinderSearchRequestConverterInterface $factFinderRequestConverter,
        FactFinderSearchResponseConverterInterface $factFinderResponseConverter,
        SearchConfig $searchConfig
    ) {
        $this->guzzleClient = $guzzleClient;
        $this->factFinderRequestConverter = $factFinderRequestConverter;
        $this->factFinderResponseConverter = $factFinderResponseConverter;
        $this->searchConfig = $searchConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderSearchRequestTransfer $factFinderSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSearchResponseTransfer
     */
    public function request(FactFinderSearchRequestTransfer $factFinderSearchRequestTransfer): FactFinderSearchResponseTransfer
    {
        $searchRequest = $this->factFinderRequestConverter->convert($factFinderSearchRequestTransfer);
        $response = $this->guzzleClient->post(
            $this->searchConfig->getFactFinderUrl(),
            [
                'searchRequest' => $searchRequest,
                'auth' => [
                    $this->searchConfig->getFactFinderUsername(),
                    $this->searchConfig->getFactFinderPassword(),
                ],
            ]
        );

        try {
            $responseTransfer = $this->factFinderResponseConverter
                ->convert($response);
        } catch (Exception $e) {
            $responseTransfer = new FactFinderSearchResponseTransfer();
        }

        return $responseTransfer;
    }
}
