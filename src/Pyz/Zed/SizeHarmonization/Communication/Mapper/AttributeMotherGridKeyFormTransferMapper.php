<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Mapper;

use Generated\Shared\Transfer\AttributeMotherGridKeyTransfer;
use Symfony\Component\Form\FormInterface;

class AttributeMotherGridKeyFormTransferMapper
{
    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return \Generated\Shared\Transfer\AttributeMotherGridKeyTransfer
     */
    public function mapToAttributeMotherGridKeyTransfer(FormInterface $form)
    {
        $formData = $form->getData();

        return $this->createAttributeMotherGridKeyTransfer($formData);
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\AttributeMotherGridKeyTransfer
     */
    protected function createAttributeMotherGridKeyTransfer(array $data)
    {
        $productAbstractTransfer = (new AttributeMotherGridKeyTransfer())
            ->fromArray($data, true);

        return $productAbstractTransfer;
    }
}
