<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Mapper;

use Generated\Shared\Transfer\AttributeMotherGridTransfer;
use Symfony\Component\Form\FormInterface;

class AttributeMotherGridFormTransferMapper
{
    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return \Generated\Shared\Transfer\AttributeMotherGridTransfer
     */
    public function mapToAttributeMotherGridTransfer(FormInterface $form)
    {
        $formData = $form->getData();

        $attributeMotherGridTransfer = $this->createAttributeMotherGridTransfer($formData);

        return $attributeMotherGridTransfer;
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\AttributeMotherGridTransfer
     */
    protected function createAttributeMotherGridTransfer(array $data)
    {
        $attributeMotherGridTransfer = (new AttributeMotherGridTransfer())
            ->fromArray($data, true);

        return $attributeMotherGridTransfer;
    }
}
