<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Client\SizeHarmonizationStorage\Storage;

use Generated\Shared\Transfer\AttributeMotherGridStorageTransfer;
use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Pyz\Shared\SizeHarmonizationStorage\SizeHarmonizationStorageConfig;
use Spryker\Client\ProductCategoryStorage\Dependency\Client\ProductCategoryStorageToStorageClientInterface;
use Spryker\Client\ProductCategoryStorage\Dependency\Service\ProductCategoryStorageToSynchronizationServiceInterface;

class AttributeMotherGridStorageReader
{
    /**
     * @var \Spryker\Client\ProductCategoryStorage\Dependency\Client\ProductCategoryStorageToStorageClientInterface
     */
    protected $storageClient;

    /**
     * @var \Spryker\Client\ProductCategoryStorage\Dependency\Service\ProductCategoryStorageToSynchronizationServiceInterface
     */
    protected $synchronizationService;

    /**
     * @param \Spryker\Client\ProductCategoryStorage\Dependency\Client\ProductCategoryStorageToStorageClientInterface $storageClient
     * @param \Spryker\Client\ProductCategoryStorage\Dependency\Service\ProductCategoryStorageToSynchronizationServiceInterface $synchronizationService
     */
    public function __construct(ProductCategoryStorageToStorageClientInterface $storageClient, ProductCategoryStorageToSynchronizationServiceInterface $synchronizationService)
    {
        $this->storageClient = $storageClient;
        $this->synchronizationService = $synchronizationService;
    }

    /**
     * @param int $idAttributeMotherGrid
     *
     * @return \Generated\Shared\Transfer\AttributeMotherGridStorageTransfer|null
     */
    public function findAttributeMotherGrid($idAttributeMotherGrid)
    {
        $synchronizationDataTransfer = new SynchronizationDataTransfer();
        $synchronizationDataTransfer
            ->setReference($idAttributeMotherGrid);

        $key = $this->synchronizationService
            ->getStorageKeyBuilder(SizeHarmonizationStorageConfig::ATTRIBUTE_MOTHER_GRID_RESOURCE_NAME)
            ->generateKey($synchronizationDataTransfer);

        $data = $this->storageClient->get($key);

        $attributeMotherGridStorageTransfer = new AttributeMotherGridStorageTransfer();
        $attributeMotherGridStorageTransfer->fromArray($data, true);

        return $attributeMotherGridStorageTransfer;
    }
}
