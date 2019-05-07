<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\SizeHarmonizationStorage\Storage;

use Generated\Shared\Transfer\AttributeMotherGridStorageTransfer;
use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Pyz\Client\SizeHarmonizationStorage\Dependency\Client\SizeHarmonizationStorageToStorageClientBridge;
use Pyz\Client\SizeHarmonizationStorage\Dependency\Service\SizeHarmonizationStorageToSynchronizationServiceBridge;
use Pyz\Shared\SizeHarmonizationStorage\SizeHarmonizationStorageConfig;

class AttributeMotherGridStorageReader
{
    /**
     * @var \Pyz\Client\SizeHarmonizationStorage\Dependency\Client\SizeHarmonizationStorageToStorageClientBridge
     */
    protected $storageClient;

    /**
     * @var \Pyz\Client\SizeHarmonizationStorage\Dependency\Service\SizeHarmonizationStorageToSynchronizationServiceBridge
     */
    protected $synchronizationService;

    /**
     * @param \Pyz\Client\SizeHarmonizationStorage\Dependency\Client\SizeHarmonizationStorageToStorageClientBridge $storageClient
     * @param \Pyz\Client\SizeHarmonizationStorage\Dependency\Service\SizeHarmonizationStorageToSynchronizationServiceBridge $synchronizationService
     */
    public function __construct(
        SizeHarmonizationStorageToStorageClientBridge $storageClient,
        SizeHarmonizationStorageToSynchronizationServiceBridge $synchronizationService
    ) {
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
        if (is_array($data)) {
            $attributeMotherGridStorageTransfer->fromArray($data, true);
        }

        return $attributeMotherGridStorageTransfer;
    }
}
