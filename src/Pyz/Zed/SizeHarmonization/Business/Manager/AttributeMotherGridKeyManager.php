<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Business\Manager;

use Generated\Shared\Transfer\AttributeMotherGridKeyTransfer;
use Orm\Zed\SizeHarmonization\Persistence\MytAttributeMotherGridKey;
use Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer;

class AttributeMotherGridKeyManager
{
    /**
     * @var \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer
     */
    protected $sizeHarmonizationQueryContainer;

    /**
     * @param \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer $sizeHarmonizationQueryContainer
     */
    public function __construct(
        SizeHarmonizationQueryContainer $sizeHarmonizationQueryContainer
    ) {
        $this->sizeHarmonizationQueryContainer = $sizeHarmonizationQueryContainer;
    }

    /**
     * @param \Generated\Shared\Transfer\AttributeMotherGridKeyTransfer $attributeMotherGridKeyTransfer
     *
     * @return int
     */
    public function addAttributeMotherGridKey(AttributeMotherGridKeyTransfer $attributeMotherGridKeyTransfer): int
    {
        $attributeMotherGridKeyEntity = new MytAttributeMotherGridKey();
        $attributeMotherGridKeyEntity->fromArray($attributeMotherGridKeyTransfer->toArray());

        $attributeMotherGridKeyEntity->save();

        return $attributeMotherGridKeyEntity->getIdAttributeMotherGridKey();
    }

    /**
     * @param \Generated\Shared\Transfer\AttributeMotherGridKeyTransfer $attributeMotherGridKeyTransfer
     *
     * @return bool
     */
    public function updateAttributeMotherGridKey(AttributeMotherGridKeyTransfer $attributeMotherGridKeyTransfer): bool
    {
        $attributeMotherGridKeyEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridKeyById($attributeMotherGridKeyTransfer->getIdAttributeMotherGridKey())
            ->findOne();

        if (!$attributeMotherGridKeyEntity) {
            return false;
        }

        $attributeMotherGridKeyEntity->fromArray($attributeMotherGridKeyTransfer->toArray());
        $attributeMotherGridKeyEntity->save();

        return true;
    }

    /**
     * @param int $idAttributeMotherGridKey
     *
     * @return void
     */
    public function deleteAttributeMotherGridKey($idAttributeMotherGridKey): void
    {
        $attributeMotherGridKeyEntity = $this
            ->sizeHarmonizationQueryContainer
            ->queryAttributeMotherGridKeyById($idAttributeMotherGridKey)
            ->findOne();

        if ($attributeMotherGridKeyEntity) {
            $attributeMotherGridKeyEntity->delete();
        }
    }
}
