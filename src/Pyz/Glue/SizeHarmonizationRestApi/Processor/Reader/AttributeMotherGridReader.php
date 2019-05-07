<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Glue\SizeHarmonizationRestApi\Processor\Reader;

use Generated\Shared\Transfer\AttributeMotherGridStorageTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Pyz\Glue\SizeHarmonizationRestApi\SizeHarmonizationRestApiConfig;
use Pyz\Glue\SizeHarmonizationRestApi\Dependency\Client\SizeHarmonizationRestApiToSizeHarmonizationStorageClientBridge;
use Pyz\Glue\SizeHarmonizationRestApi\Processor\Mapper\AttributeMotherGridMapper;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\Response;

class AttributeMotherGridReader
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
     * @var \Pyz\Glue\SizeHarmonizationRestApi\Processor\Mapper\AttributeMotherGridMapper
     */
    protected $attributeMotherGridMapper;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \Pyz\Glue\SizeHarmonizationRestApi\Dependency\Client\SizeHarmonizationRestApiToSizeHarmonizationStorageClientBridge $storageClient
     * @param \Pyz\Glue\SizeHarmonizationRestApi\Processor\Mapper\AttributeMotherGridMapper $attributeMotherGridMapper
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        SizeHarmonizationRestApiToSizeHarmonizationStorageClientBridge $storageClient,
        AttributeMotherGridMapper $attributeMotherGridMapper
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->sizeHarmonizationStorageClient = $storageClient;
        $this->attributeMotherGridMapper = $attributeMotherGridMapper;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function readAttributeMotherGrid(RestRequestInterface $restRequest): RestResponseInterface
    {
        $attributeMotherGridId = $restRequest->getResource()->getId();
        if (!$this->isAttributeMotherGridIdValid($attributeMotherGridId)) {
            return $this->createInvalidIdResponse($this->restResourceBuilder->createRestResponse());
        }

        return $this->getAttributeMotherGrid($attributeMotherGridId);
    }

    /**
     * @param int $attributeMotherGridId
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function getAttributeMotherGrid($attributeMotherGridId): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $restResource = $this->findAttributeMotherGridById((int)$attributeMotherGridId);
        if (!$restResource) {
            return $this->createErrorResponse($restResponse);
        }

        return $restResponse->addResource($restResource);
    }

    /**
     * @param int $attributeMotherGridId
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface|null
     */
    protected function findAttributeMotherGridById(int $attributeMotherGridId): ?RestResourceInterface
    {
        $attributeMotherGridStorageTransfer = $this->sizeHarmonizationStorageClient->findAttributeMotherGrid($attributeMotherGridId);
        if (!$attributeMotherGridStorageTransfer->getIdAttributeMotherGrid()) {
            return null;
        }

        return $this->buildResource($attributeMotherGridStorageTransfer);
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
            ->setDetail(SizeHarmonizationRestApiConfig::RESPONSE_DETAILS_AMG_NOT_FOUND);

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
            ->setDetail(SizeHarmonizationRestApiConfig::RESPONSE_DETAILS_INVALID_AMG_ID);

        return $restResponse->addError($restErrorTransfer);
    }

    /**
     * @param string|null $nodeId
     *
     * @return bool
     */
    protected function isAttributeMotherGridIdValid(?string $nodeId): bool
    {
        if (!$nodeId) {
            return false;
        }

        return true;
    }

    /**
     * @param \Generated\Shared\Transfer\AttributeMotherGridStorageTransfer $attributeMotherGridStorageTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected function buildResource(AttributeMotherGridStorageTransfer $attributeMotherGridStorageTransfer): RestResourceInterface
    {
        $restAttributeMotherGridTransfer = $this->attributeMotherGridMapper
            ->mapAttributeMotherGridToRestAttributeMotherGridTransfer($attributeMotherGridStorageTransfer);

        return $this
            ->restResourceBuilder
            ->createRestResource(
                SizeHarmonizationRestApiConfig::RESOURCE_ATTRIBUTE_MOTHER_GRID,
                (string)$restAttributeMotherGridTransfer->getIdAttributeMotherGrid(),
                $restAttributeMotherGridTransfer
            );
    }
}
