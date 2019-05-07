<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Glue\SizeHarmonizationRestApi\Processor\Reader;

use Generated\Shared\Transfer\AttributeGridProductAbstractStorageTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Pyz\Glue\SizeHarmonizationRestApi\Processor\Mapper\AttributeGridMapper;
use Pyz\Glue\SizeHarmonizationRestApi\SizeHarmonizationRestApiConfig;
use Pyz\Glue\SizeHarmonizationRestApi\Dependency\Client\SizeHarmonizationRestApiToSizeHarmonizationStorageClientBridge;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\Response;

class AttributeGridReader
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var \Pyz\Glue\SizeHarmonizationRestApi\Dependency\Client\SizeHarmonizationRestApiToSizeHarmonizationStorageClientBridge
     */
    protected $sizeHarmonizationStorageClient;

    /**
     * @var \Pyz\Glue\SizeHarmonizationRestApi\Processor\Mapper\AttributeGridMapper
     */
    protected $attributeGridMapper;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \Pyz\Glue\SizeHarmonizationRestApi\Dependency\Client\SizeHarmonizationRestApiToSizeHarmonizationStorageClientBridge $storageClient
     * @param \Pyz\Glue\SizeHarmonizationRestApi\Processor\Mapper\AttributeGridMapper $attributeGridMapper
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        SizeHarmonizationRestApiToSizeHarmonizationStorageClientBridge $storageClient,
        AttributeGridMapper $attributeGridMapper
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->sizeHarmonizationStorageClient = $storageClient;
        $this->attributeGridMapper = $attributeGridMapper;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function readAttributeGrid(RestRequestInterface $restRequest): RestResponseInterface
    {
        $productAbstractId = $restRequest->getResource()->getId();
        if (!$this->isProductAbstractIdValid($productAbstractId)) {
            return $this->createInvalidIdResponse($this->restResourceBuilder->createRestResponse());
        }

        return $this->getAttributeGrid($productAbstractId);
    }

    /**
     * @param int $productAbstractId
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function getAttributeGrid($productAbstractId): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $restResource = $this->findAttributeGridByProductAbstractId((int)$productAbstractId);
        if (!$restResource) {
            return $this->createErrorResponse($restResponse);
        }

        return $restResponse->addResource($restResource);
    }

    /**
     * @param int $productAbstractId
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface|null
     */
    protected function findAttributeGridByProductAbstractId(int $productAbstractId): ?RestResourceInterface
    {
        $attributeGridProductAbstractStorageTransfer = $this->sizeHarmonizationStorageClient->findAttributeGridProductAbstract($productAbstractId);
        if (!$attributeGridProductAbstractStorageTransfer->getIdProductAbstract()) {
            return null;
        }

        return $this->buildResource($attributeGridProductAbstractStorageTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function createErrorResponse(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode(SizeHarmonizationRestApiConfig::RESPONSE_CODE_RESOURCE_NOT_FOUND)
            ->setStatus(Response::HTTP_NOT_FOUND)
            ->setDetail(SizeHarmonizationRestApiConfig::RESPONSE_DETAILS_ATTRIBUTE_GRID_NOT_FOUND);

        return $restResponse->addError($restErrorTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function createInvalidIdResponse(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode(SizeHarmonizationRestApiConfig::RESPONSE_CODE_INVALID_ID)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setDetail(SizeHarmonizationRestApiConfig::RESPONSE_DETAILS_INVALID_PRODUCT_ABSTRACT_ID);

        return $restResponse->addError($restErrorTransfer);
    }

    /**
     * @param string|null $nodeId
     *
     * @return bool
     */
    protected function isProductAbstractIdValid(?string $nodeId): bool
    {
        if (!$nodeId) {
            return false;
        }

        return true;
    }

    /**
     * @param \Generated\Shared\Transfer\AttributeGridProductAbstractStorageTransfer $attributeGridProductAbstractStorageTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected function buildResource(AttributeGridProductAbstractStorageTransfer $attributeGridProductAbstractStorageTransfer): RestResourceInterface
    {
        $restAttributeGridProductAbstractTransfer = $this->attributeGridMapper
            ->mapAttributeGridToRestAttributeGridProductAbstractTransfer($attributeGridProductAbstractStorageTransfer);

        return $this
            ->restResourceBuilder
            ->createRestResource(
                SizeHarmonizationRestApiConfig::RESOURCE_ATTRIBUTE_GRID,
                (string)$restAttributeGridProductAbstractTransfer->getIdProductAbstract(),
                $restAttributeGridProductAbstractTransfer
            );
    }
}
