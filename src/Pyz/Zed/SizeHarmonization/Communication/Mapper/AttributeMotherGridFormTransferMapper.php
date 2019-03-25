<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
        $productAbstractTransfer = (new AttributeMotherGridTransfer())
            ->fromArray($data, true);

        return $productAbstractTransfer;
    }
}
