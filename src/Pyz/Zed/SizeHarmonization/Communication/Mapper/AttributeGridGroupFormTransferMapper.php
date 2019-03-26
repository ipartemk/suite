<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Mapper;

use Generated\Shared\Transfer\AttributeGridGroupTransfer;
use Symfony\Component\Form\FormInterface;

class AttributeGridGroupFormTransferMapper
{
    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return \Generated\Shared\Transfer\AttributeGridGroupTransfer
     */
    public function mapToAttributeGridGroupTransfer(FormInterface $form)
    {
        $formData = $form->getData();

        $attributeMotherGridTransfer = $this->createAttributeGridGroupTransfer($formData);

        return $attributeMotherGridTransfer;
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\AttributeGridGroupTransfer
     */
    protected function createAttributeGridGroupTransfer(array $data)
    {
        $productAbstractTransfer = (new AttributeGridGroupTransfer())
            ->fromArray($data, true);

        return $productAbstractTransfer;
    }
}
