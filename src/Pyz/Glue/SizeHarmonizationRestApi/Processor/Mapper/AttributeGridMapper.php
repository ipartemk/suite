<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Glue\SizeHarmonizationRestApi\Processor\Mapper;

use Generated\Shared\Transfer\AttributeGridProductAbstractStorageTransfer;
use Generated\Shared\Transfer\RestAttributeGridProductAbstractTransfer;

class AttributeGridMapper
{
    /**
     * @param \Generated\Shared\Transfer\AttributeGridProductAbstractStorageTransfer $attributeGridProductAbstractStorageTransfer
     *
     * @return \Generated\Shared\Transfer\RestAttributeGridProductAbstractTransfer
     */
    public function mapAttributeGridToRestAttributeGridProductAbstractTransfer(AttributeGridProductAbstractStorageTransfer $attributeGridProductAbstractStorageTransfer): RestAttributeGridProductAbstractTransfer
    {
        return (new RestAttributeGridProductAbstractTransfer())
            ->fromArray(
                $attributeGridProductAbstractStorageTransfer->toArray(),
                true
            );
    }
}
