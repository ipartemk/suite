<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Search\Api\Request;

use Exception;
use Generated\Shared\Transfer\FactFinderSearchRequestTransfer;
use Generated\Shared\Transfer\FactFinderSearchResponseTransfer;

class FactFinderSearchRequest implements FactFinderSearchRequestInterface
{
    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\FactFinderConnectorInterface
     */
    protected $factFinderConnector;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\ConverterFactory
     */
    protected $converterFactory;

    /**
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\FactFinderConnectorInterface $factFinderConnector
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\ConverterFactory $converterFactory
     */
    public function __construct(
        FactFinderConnectorInterface $factFinderConnector,
        ConverterFactory $converterFactory
    ) {

        $this->factFinderConnector = $factFinderConnector;
        $this->converterFactory = $converterFactory;
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderSearchRequestTransfer $factFinderSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSearchResponseTransfer
     */
    public function request(FactFinderSearchRequestTransfer $factFinderSearchRequestTransfer)
    {
        $requestParameters = $this->factFinderConnector
            ->createRequestParametersFromSearchRequestTransfer($factFinderSearchRequestTransfer);
        $requestParameters = $this->convertCategoryParameters($requestParameters);
        $this->factFinderConnector->setRequestParameters($requestParameters);

        $searchAdapter = $this->factFinderConnector->createSearchAdapter();

        try {
            $responseTransfer = $this->converterFactory
                ->createSearchResponseConverter($searchAdapter)
                ->convert();
        } catch (Exception $e) {
            $responseTransfer = new FactFinderSdkSearchResponseTransfer();
        }

        return $responseTransfer;
    }

    /**
     * @param \FACTFinder\Util\Parameters $parameters
     *
     * @return \FACTFinder\Util\Parameters
     */
    protected function convertCategoryParameters(Parameters $parameters)
    {
        $parametersArray = $parameters->getArray();

        foreach ($parametersArray as $key => $parameter) {
            if (strpos($key, static::REQUEST_CATEGORY_PATH_ROOT_NAME) !== false) {
                unset($parametersArray[$key]);
                $newKey = str_replace('_', ' ', $key);
                $parametersArray[$newKey] = $parameter;
            }
        }

        $parameters->clear();
        $parameters->setAll($parametersArray);

        return $parameters;
    }
}
