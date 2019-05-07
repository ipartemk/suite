<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Glue\SizeHarmonizationRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class SizeHarmonizationRestApiConfig extends AbstractBundleConfig
{
    public const RESOURCE_AMG_ACTION_NAME = 'get';
    public const RESOURCE_AMG_IS_PROTECTED = false;

    public const RESOURCE_ATTRIBUTE_GRID_ACTION_NAME = 'get';
    public const RESOURCE_ATTRIBUTE_GRID_IS_PROTECTED = false;

    public const RESOURCE_ATTRIBUTE_MOTHER_GRID = 'attribute-mother-grid';
    public const RESOURCE_ATTRIBUTE_GRID = 'attribute-grid';

    public const CONTROLLER_ATTRIBUTE_MOTHER_GRID = 'attribute-mother-grid-resource';
    public const CONTROLLER_ATTRIBUTE_GRID = 'attribute-grid-resource';

    public const RESPONSE_CODE_INVALID_ID = '400';
    public const RESPONSE_CODE_RESOURCE_NOT_FOUND = '404';

    public const RESPONSE_DETAILS_INVALID_AMG_ID = 'AMG id has not been specified or invalid.';
    public const RESPONSE_DETAILS_AMG_NOT_FOUND = 'Can\'t find AMG with the given id.';

    public const RESPONSE_DETAILS_INVALID_PRODUCT_ABSTRACT_ID = 'Product abstract id has not been specified or invalid.';
    public const RESPONSE_DETAILS_ATTRIBUTE_GRID_NOT_FOUND = 'Can\'t find Attribute grids with the given id.';
}
