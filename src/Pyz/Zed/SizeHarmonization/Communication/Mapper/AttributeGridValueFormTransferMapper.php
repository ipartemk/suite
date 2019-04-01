<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Mapper;

use Generated\Shared\Transfer\AttributeGridValueTransfer;
use Symfony\Component\Form\FormInterface;

class AttributeGridValueFormTransferMapper
{
    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return \Generated\Shared\Transfer\AttributeGridValueTransfer
     */
    public function mapToAttributeGridValueTransfer(FormInterface $form)
    {
        $formData = $form->getData();

        return $this->createAttributeGridValueTransfer($formData);
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\AttributeGridValueTransfer
     */
    protected function createAttributeGridValueTransfer(array $data)
    {
        $attributeGridValueTransfer = (new AttributeGridValueTransfer())
            ->fromArray($data, true);

        return $attributeGridValueTransfer;
    }
}
