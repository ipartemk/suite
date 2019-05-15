<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonizationStorage\Business\Storage;

use Exception;
use Generated\Shared\Transfer\AttributeGridCountryStorageTransfer;
use Generated\Shared\Transfer\AttributeGridProductAbstractStorageTransfer;
use Generated\Shared\Transfer\AttributeGridValueStorageTransfer;
use Orm\Zed\SizeHarmonizationStorage\Persistence\MytAttributeGridStorage;
use Pyz\Zed\SizeHarmonizationStorage\Persistence\SizeHarmonizationStorageQueryContainerInterface;

class AttributeGridStorageWriter
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
     * @param array $productAbstractIds
     *
     * @return void
     */
    public function publish(array $productAbstractIds)
    {
        $amgProductAbstractEntities = $this->findAmgProductAbstractEntities($productAbstractIds);
        $countries = [];
        $attributeGridProductAbstractStorageTransfers = [];

        /** @var \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridProductAbstract $amgProductAbstractEntity */
        foreach ($amgProductAbstractEntities as $amgProductAbstractEntity) {
            if (!isset($attributeGridProductAbstractStorageTransfers[$amgProductAbstractEntity->getFkProductAbstract()])) {
                $attributeGridProductAbstractStorageTransfer = new AttributeGridProductAbstractStorageTransfer();
                $attributeGridProductAbstractStorageTransfers[$amgProductAbstractEntity->getFkProductAbstract()] = $attributeGridProductAbstractStorageTransfer;
            } else {
                $attributeGridProductAbstractStorageTransfer = $attributeGridProductAbstractStorageTransfers[$amgProductAbstractEntity->getFkProductAbstract()];
            }

            $attributeGridProductAbstractStorageTransfer->setIdProductAbstract($amgProductAbstractEntity->getFkProductAbstract());
            $productAbstractEntity = $amgProductAbstractEntity->getSpyProductAbstract();
            if ($productAbstractEntity->getFkAttributeGridGroup()) {
                $attributeGridProductAbstractStorageTransfer->setIdAttributeGridGroup($productAbstractEntity->getFkAttributeGridGroup());
                $attributeGridProductAbstractStorageTransfer->setAttributeGridGroup(
                    $productAbstractEntity->getMytAttributeGridGroup()->getGroup()
                );
            }

            $countryProduct = $amgProductAbstractEntity->getFkProductAbstract() . "_" . $amgProductAbstractEntity->getCountry();
            $country = $amgProductAbstractEntity->getCountry();
            if (!isset($countries[$countryProduct])) {
                $countries[$countryProduct] = 1;

                $attributeGridCountryStorageTransfer = new AttributeGridCountryStorageTransfer();
                $attributeGridCountryStorageTransfer->setCountry($country);
                $attributeGridProductAbstractStorageTransfer->addCountryValue($attributeGridCountryStorageTransfer);
            } else {
                $attributeGridCountryStorageTransfer = $this->findCountryStorageTransfer($attributeGridProductAbstractStorageTransfer, $country);
            }

            $attributeGridCountryStorageTransfer->setCountry($country);
            $attributeMotherGridEntity = $amgProductAbstractEntity->getMytAttributeMotherGrid();
            $attributeGridCountryStorageTransfer->fromArray($attributeMotherGridEntity->toArray(), true);

            $attributeMotherGridValueEntities = $this->queryContainer
                ->queryAttributeMotherGridValuesByAttributeMotherGrid($attributeMotherGridEntity->getIdAttributeMotherGrid())
                ->find();
            foreach ($attributeMotherGridValueEntities as $attributeMotherGridValueEntity) {
                $attributeGridValueStorageTransfer = new AttributeGridValueStorageTransfer();
                $attributeGridValueStorageTransfer->fromArray($attributeMotherGridValueEntity->toArray(), true);
                $attributeMotherGridKeyEntity = $attributeMotherGridValueEntity->getMytAttributeMotherGridKey();
                $attributeGridValueStorageTransfer->fromArray(
                    $attributeMotherGridKeyEntity->toArray(),
                    true
                );
                $attributeMotherGridColEntity = $attributeMotherGridValueEntity->getMytAttributeMotherGridCol();
                $attributeGridValueStorageTransfer->fromArray(
                    $attributeMotherGridColEntity->toArray(),
                    true
                );
                //set AG_value
                if ($productAbstractEntity->getFkAttributeGridGroup()) {
                    $attributeGridValueEntity = $this->findAttributeGridValueEntityByKeyAndColAndGroup(
                        $attributeMotherGridKeyEntity->getIdAttributeMotherGridKey(),
                        $attributeMotherGridColEntity->getIdAttributeMotherGridCol(),
                        $productAbstractEntity->getFkAttributeGridGroup()
                    );
                    if ($attributeGridValueEntity) {
                        $attributeGridValueStorageTransfer->setIdAttributeGridValue($attributeGridValueEntity->getIdAttributeGridValue());
                        $attributeGridValueStorageTransfer->setValue($attributeGridValueEntity->getValue());
                    }
                }

                $attributeGridCountryStorageTransfer->addValue($attributeGridValueStorageTransfer);
            }
        }

        foreach ($attributeGridProductAbstractStorageTransfers as $productAbstractId => $attributeGridProductAbstractStorageTransfer) {
            $this->store($productAbstractId, $attributeGridProductAbstractStorageTransfer);
        }
    }

    /**
     * @param array $productAbstractIds
     *
     * @return void
     */
    public function unpublish(array $productAbstractIds)
    {
        $storageEntities = $this->queryContainer
            ->queryAttributeGridStorageByProductAbstractIds($productAbstractIds)
            ->find();

        foreach ($storageEntities as $attributeGridStorageEntity) {
            $attributeGridStorageEntity->delete();
        }
    }

    /**
     * @param int $idMessage
     * @param \Generated\Shared\Transfer\AttributeGridProductAbstractStorageTransfer $attributeGridProductAbstractStorageTransfer
     *
     * @return void
     */
    protected function store($idMessage, AttributeGridProductAbstractStorageTransfer $attributeGridProductAbstractStorageTransfer)
    {
        $storageEntity = $this->queryContainer
            ->queryAttributeGridStorageByProductAbstractId($idMessage)
            ->findOne();
        if (!$storageEntity) {
            $storageEntity = new MytAttributeGridStorage();
        }

        $storageEntity->setFkProductAbstract($idMessage);
        $storageEntity->setFkAttributeGridGroup($attributeGridProductAbstractStorageTransfer->getIdAttributeGridGroup());
        $storageEntity->setAttributeGridGroup($attributeGridProductAbstractStorageTransfer->getAttributeGridGroup());
        $storageEntity->setFkProductAbstract($idMessage);
        $storageEntity->setData($attributeGridProductAbstractStorageTransfer->modifiedToArray());
        $storageEntity->save();
    }

    /**
     * @param array $productAbstractIds
     *
     * return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridProductAbstract[]
     *
     * @return array
     */
    protected function findAmgProductAbstractEntities(array $productAbstractIds)
    {
        return $this->queryContainer
            ->queryAttributeMotherGridProductAbstractByProductIds($productAbstractIds)
            ->distinct()
            ->find();
    }

    /**
     * @param int $idAmgKey
     * @param int $idAmgCol
     * @param int $idAgGroup
     *
     * @return \Orm\Zed\SizeHarmonization\Persistence\MytAttributeGridValue
     */
    protected function findAttributeGridValueEntityByKeyAndColAndGroup($idAmgKey, $idAmgCol, $idAgGroup)
    {
        return $this->queryContainer
            ->queryAttributeGridValueByKeyAndColAndGroup($idAmgKey, $idAmgCol, $idAgGroup)
            ->findOne();
    }

    /**
     * @param \Generated\Shared\Transfer\AttributeGridProductAbstractStorageTransfer $attributeGridProductAbstractStorageTransfer
     * @param string $country
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\AttributeGridCountryStorageTransfer
     */
    protected function findCountryStorageTransfer(AttributeGridProductAbstractStorageTransfer $attributeGridProductAbstractStorageTransfer, $country)
    {
        foreach ($attributeGridProductAbstractStorageTransfer->getCountryValues() as $attributeGridCountryStorageTransfer) {
            if ($attributeGridCountryStorageTransfer->getCountry() == $country) {
                return $attributeGridCountryStorageTransfer;
            }
        }

        throw new Exception(sprintf("Country %s was'n found", $country));
    }
}
