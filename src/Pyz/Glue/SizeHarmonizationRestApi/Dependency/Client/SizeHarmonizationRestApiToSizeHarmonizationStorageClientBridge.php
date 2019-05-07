<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Glue\SizeHarmonizationRestApi\Dependency\Client;

class SizeHarmonizationRestApiToSizeHarmonizationStorageClientBridge
{
    /**
     * @var \Pyz\Client\SizeHarmonizationStorage\SizeHarmonizationStorageClientInterface
     */
    protected $sizeHarmonizationStorageClient;

    /**
     * @param \Pyz\Client\SizeHarmonizationStorage\SizeHarmonizationStorageClientInterface $sizeHarmonizationStorageClient
     */
    public function __construct($sizeHarmonizationStorageClient)
    {
        $this->sizeHarmonizationStorageClient = $sizeHarmonizationStorageClient;
    }

    /**
     * @param int $idAttributeMotherGrid
     *
     * @return \Generated\Shared\Transfer\AttributeMotherGridStorageTransfer|null
     */
    public function findAttributeMotherGrid($idAttributeMotherGrid)
    {
        return $this->sizeHarmonizationStorageClient->findAttributeMotherGrid($idAttributeMotherGrid);
    }

    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\AttributeGridProductAbstractStorageTransfer|null
     */
    public function findAttributeGridProductAbstract($idProductAbstract)
    {
        return $this->sizeHarmonizationStorageClient->findAttributeGridProductAbstract($idProductAbstract);
    }
}
