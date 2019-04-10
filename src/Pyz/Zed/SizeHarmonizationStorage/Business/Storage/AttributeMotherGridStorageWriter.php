<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\SizeHarmonizationStorage\Business\Storage;

use Generated\Shared\Transfer\AttributeMotherGridStorageTransfer;
use Generated\Shared\Transfer\AttributeMotherGridValueStorageTransfer;
use Orm\Zed\SizeHarmonizationStorage\Persistence\MytAttributeMotherGridStorage;
use Pyz\Zed\SizeHarmonizationStorage\Persistence\SizeHarmonizationStorageQueryContainerInterface;

class AttributeMotherGridStorageWriter
{
    /**
     * @var \Pyz\Zed\SizeHarmonizationStorage\Persistence\SizeHarmonizationStorageQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @param \Pyz\Zed\SizeHarmonizationStorage\Persistence\SizeHarmonizationStorageQueryContainerInterface $queryContainer
     */
    public function __construct(
        SizeHarmonizationStorageQueryContainerInterface $queryContainer
    ) {
        $this->queryContainer = $queryContainer;
    }

    /**
     * @param array $attributeMotherGridIds
     *
     * @return void
     */
    public function publish(array $attributeMotherGridIds)
    {
        $attributeMotherGridEntities = $this->findAttributeMotherGridEntities($attributeMotherGridIds);

        foreach ($attributeMotherGridEntities as $attributeMotherGridEntity) {
            $attributeMotherGridStorageTransfer = new AttributeMotherGridStorageTransfer();
            $attributeMotherGridStorageTransfer->fromArray($attributeMotherGridEntity->toArray(), true);

            $attributeMotherGridValueEntities = $this->queryContainer->queryAttributeMotherGridValuesByAttributeMotherGrid($attributeMotherGridEntity->getIdAttributeMotherGrid());
            foreach($attributeMotherGridValueEntities as $attributeMotherGridValueEntity) {
                $attributeMotherGridValueStorageTransfer = new AttributeMotherGridValueStorageTransfer();
                $attributeMotherGridValueStorageTransfer->fromArray($attributeMotherGridValueEntity->toArray(), true);
                $attributeMotherGridValueStorageTransfer->fromArray(
                    $attributeMotherGridValueEntity->getMytAttributeMotherGridKey()->toArray(), true
                );
                $attributeMotherGridValueStorageTransfer->fromArray(
                    $attributeMotherGridValueEntity->getMytAttributeMotherGridCol()->toArray(), true
                );

                $attributeMotherGridStorageTransfer->addValue($attributeMotherGridValueStorageTransfer);
            }

            $this->store($attributeMotherGridEntity->getIdAttributeMotherGrid(), $attributeMotherGridStorageTransfer);
        }
    }

    /**
     * @param array $productAbstractIds
     *
     * @return void
     */
    public function unpublish(array $productAbstractIds)
    {
        $attributeMotherGridStorageEntities = $this->queryContainer
            ->queryAttributeMotherGridStorageByAttributeMotherGridIds($productAbstractIds)
            ->find();

        foreach ($attributeMotherGridStorageEntities as $attributeMotherGridStorageEntity) {
            $attributeMotherGridStorageEntity->delete();
        }
    }

    /**
     * @param $idMessage
     * @param \Generated\Shared\Transfer\AttributeMotherGridStorageTransfer $attributeMotherGridStorageTransfer
     */
    protected function store($idMessage, AttributeMotherGridStorageTransfer $attributeMotherGridStorageTransfer)
    {
        $storageEntity = $this->queryContainer
            ->queryAttributeMotherGridStorageByAttributeMotherGridId($idMessage)
            ->findOne();
        if (!$storageEntity) {
            $storageEntity = new MytAttributeMotherGridStorage();
        }

        $storageEntity->setFkAttributeMotherGrid($idMessage);
        $storageEntity->setData($attributeMotherGridStorageTransfer->modifiedToArray());
        $storageEntity->save();
    }

    /**
     * @param array $attributeMotherGridIds
     *
     * @return array
     */
    protected function findAttributeMotherGridEntities(array $attributeMotherGridIds)
    {
        return $this->queryContainer
            ->queryAttributeMotherGridByIds($attributeMotherGridIds)
            ->find()
            ->getData();
    }
}
