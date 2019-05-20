<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Glue\SizeHarmonizationRestApi\Plugin;

use Generated\Shared\Transfer\RestAttributeGridProductAbstractTransfer;
use Pyz\Glue\SizeHarmonizationRestApi\SizeHarmonizationRestApiConfig;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

/**
 * @method \Pyz\Glue\SizeHarmonizationRestApi\SizeHarmonizationRestApiFactory getFactory()
 * @method \Pyz\Glue\SizeHarmonizationRestApi\SizeHarmonizationRestApiConfig getConfig()
 */
class AttributeGridResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(ResourceRouteCollectionInterface $resourceRouteCollection): ResourceRouteCollectionInterface
    {
        $resourceRouteCollection->addGet(
            SizeHarmonizationRestApiConfig::RESOURCE_ATTRIBUTE_GRID_ACTION_NAME,
            SizeHarmonizationRestApiConfig::RESOURCE_ATTRIBUTE_GRID_IS_PROTECTED
        );

        return $resourceRouteCollection;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getResourceType(): string
    {
        return SizeHarmonizationRestApiConfig::RESOURCE_ATTRIBUTE_GRID;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getController(): string
    {
        return SizeHarmonizationRestApiConfig::CONTROLLER_ATTRIBUTE_GRID;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestAttributeGridProductAbstractTransfer::class;
    }
}