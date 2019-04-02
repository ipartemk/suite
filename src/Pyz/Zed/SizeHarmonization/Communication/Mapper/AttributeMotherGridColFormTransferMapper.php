<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Mapper;

use Generated\Shared\Transfer\AttributeMotherGridColTransfer;
use Symfony\Component\Form\FormInterface;

class AttributeMotherGridColFormTransferMapper
{
    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return \Generated\Shared\Transfer\AttributeMotherGridColTransfer
     */
    public function mapToAttributeMotherGridColTransfer(FormInterface $form)
    {
        $formData = $form->getData();

        return $this->createAttributeMotherGridColTransfer($formData);
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\AttributeMotherGridColTransfer
     */
    protected function createAttributeMotherGridColTransfer(array $data)
    {
        $attributeMotherGridColTransfer = (new AttributeMotherGridColTransfer())
            ->fromArray($data, true);

        return $attributeMotherGridColTransfer;
    }
}
