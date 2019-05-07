<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Glue\SizeHarmonizationRestApi\Processor\Mapper;

use Generated\Shared\Transfer\AttributeMotherGridStorageTransfer;
use Generated\Shared\Transfer\RestAttributeMotherGridTransfer;

class AttributeMotherGridMapper
{
    /**
     * @param \Generated\Shared\Transfer\AttributeMotherGridStorageTransfer $attributeMotherGridStorageTransfer
     *
     * @return \Generated\Shared\Transfer\RestAttributeMotherGridTransfer
     */
    public function mapAttributeMotherGridToRestAttributeMotherGridTransfer(AttributeMotherGridStorageTransfer $attributeMotherGridStorageTransfer): RestAttributeMotherGridTransfer
    {
        return (new RestAttributeMotherGridTransfer())
            ->fromArray(
                $attributeMotherGridStorageTransfer->toArray(),
                true
            );
    }
}
