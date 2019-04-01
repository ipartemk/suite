<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Mapper;

use Generated\Shared\Transfer\AttributeMotherGridValueTransfer;
use Symfony\Component\Form\FormInterface;

class AttributeMotherGridValueFormTransferMapper
{
    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return \Generated\Shared\Transfer\AttributeMotherGridValueTransfer
     */
    public function mapToAttributeMotherGridValueTransfer(FormInterface $form)
    {
        $formData = $form->getData();

        return $this->createAttributeMotherGridValueTransfer($formData);
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\AttributeMotherGridValueTransfer
     */
    protected function createAttributeMotherGridValueTransfer(array $data)
    {
        $attributeMotherGridValueTransfer = (new AttributeMotherGridValueTransfer())
            ->fromArray($data, true);

        return $attributeMotherGridValueTransfer;
    }
}
