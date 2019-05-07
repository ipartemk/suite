<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Glue\SizeHarmonizationRestApi;

use Pyz\Glue\SizeHarmonizationRestApi\Dependency\Client\SizeHarmonizationRestApiToSizeHarmonizationStorageClientBridge;
use Pyz\Glue\SizeHarmonizationRestApi\Processor\Mapper\AttributeGridMapper;
use Pyz\Glue\SizeHarmonizationRestApi\Processor\Mapper\AttributeMotherGridMapper;
use Pyz\Glue\SizeHarmonizationRestApi\Processor\Reader\AttributeGridReader;
use Pyz\Glue\SizeHarmonizationRestApi\Processor\Reader\AttributeMotherGridReader;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface getResourceBuilder()
 */
class SizeHarmonizationRestApiFactory extends AbstractFactory
{
    /**
     * @return \Pyz\Glue\SizeHarmonizationRestApi\Processor\Reader\AttributeMotherGridReader
     */
    public function createAttributeMotherGridReader(): AttributeMotherGridReader
    {
        return new AttributeMotherGridReader(
            $this->getResourceBuilder(),
            $this->getCategoryStorageClient(),
            $this->createAttributeMotherGridMapper()
        );
    }

    /**
     * @return \Pyz\Glue\SizeHarmonizationRestApi\Processor\Reader\AttributeGridReader
     */
    public function createAttributeGridReader(): AttributeGridReader
    {
        return new AttributeGridReader(
            $this->getResourceBuilder(),
            $this->getCategoryStorageClient(),
            $this->createAttributeGridMapper()
        );
    }

    /**
     * @return \Pyz\Glue\SizeHarmonizationRestApi\Dependency\Client\SizeHarmonizationRestApiToSizeHarmonizationStorageClientBridge
     */
    protected function getCategoryStorageClient(): SizeHarmonizationRestApiToSizeHarmonizationStorageClientBridge
    {
        return $this->getProvidedDependency(SizeHarmonizationRestApiDependencyProvider::CLIENT_CATEGORY_STORAGE);
    }

    /**
     * @return \Pyz\Glue\SizeHarmonizationRestApi\Processor\Mapper\AttributeMotherGridMapper
     */
    protected function createAttributeMotherGridMapper(): AttributeMotherGridMapper
    {
        return new AttributeMotherGridMapper();
    }

    /**
     * @return \Pyz\Glue\SizeHarmonizationRestApi\Processor\Mapper\AttributeGridMapper
     */
    protected function createAttributeGridMapper(): AttributeGridMapper
    {
        return new AttributeGridMapper();
    }
}
