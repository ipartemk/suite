<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search\Api\Adapter;

use Exception;
use Generated\Shared\Transfer\FactFinderSearchResponseTransfer;
use Generated\Shared\Transfer\FactFinderSuggestRequestTransfer;
use Generated\Shared\Transfer\FactFinderSuggestResponseTransfer;
use GuzzleHttp\Client;
use Pyz\Client\Search\Api\Converter\FactFinderSuggestRequestConverterInterface;
use Pyz\Client\Search\Api\Converter\FactFinderSuggestResponseConverterInterface;
use Pyz\Client\Search\SearchConfig;

class FactFinderSuggestAdapter implements FactFinderSuggestAdapterInterface
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $guzzleClient;

    /**
     * @var \Pyz\Client\Search\Api\Converter\FactFinderSuggestRequestConverterInterface
     */
    protected $factFinderRequestConverter;

    /**
     * @var \Pyz\Client\Search\Api\Converter\FactFinderSuggestResponseConverterInterface
     */
    protected $factFinderResponseConverter;

    /**
     * @var \Pyz\Client\Search\SearchConfig
     */
    protected $searchConfig;

    /**
     * @param \GuzzleHttp\Client $guzzleClient
     * @param \Pyz\Client\Search\Api\Converter\FactFinderSuggestRequestConverterInterface $factFinderRequestConverter
     * @param \Pyz\Client\Search\Api\Converter\FactFinderSuggestResponseConverterInterface $factFinderResponseConverter
     * @param \Pyz\Client\Search\SearchConfig $searchConfig
     */
    public function __construct(
        Client $guzzleClient,
        FactFinderSuggestRequestConverterInterface $factFinderRequestConverter,
        FactFinderSuggestResponseConverterInterface $factFinderResponseConverter,
        SearchConfig $searchConfig
    ) {
        $this->guzzleClient = $guzzleClient;
        $this->factFinderRequestConverter = $factFinderRequestConverter;
        $this->factFinderResponseConverter = $factFinderResponseConverter;
        $this->searchConfig = $searchConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderSuggestRequestTransfer $factFinderSuggestRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSuggestResponseTransfer
     */
    public function request(FactFinderSuggestRequestTransfer $factFinderSuggestRequestTransfer): FactFinderSuggestResponseTransfer
    {
        $params = $this->factFinderRequestConverter->convert($factFinderSuggestRequestTransfer);
        $response = $this->guzzleClient->post(
            $this->searchConfig->getFactFinderUrl(),
            [
                'params' => $params,
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
