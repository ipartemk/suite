<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication;

use Pyz\Zed\SizeHarmonization\Communication\Form\AttributeMotherGridFormAdd;
use Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider\AttributeMotherGridFormAddDataProvider;
use Pyz\Zed\SizeHarmonization\Communication\Mapper\AttributeMotherGridFormTransferMapper;
use Pyz\Zed\SizeHarmonization\Communication\Table\AttributeMotherGridTable;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainer getQueryContainer()
 * @method \Pyz\Zed\SizeHarmonization\SizeHarmonizationConfig getConfig()
 * @method \Pyz\Zed\SizeHarmonization\Business\SizeHarmonizationFacadeInterface getFacade()
 */
class SizeHarmonizationCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Spryker\Zed\Gui\Communication\Table\AbstractTable
     */
    public function createAttributeMotherGridTable()
    {
        return new AttributeMotherGridTable(
            $this->getQueryContainer()
        );
    }

    /**
     * @param array $formData
     * @param array $formOptions
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createAttributeMotherGridFormAdd(array $formData, array $formOptions = [])
    {
        return $this->getFormFactory()->create(AttributeMotherGridFormAdd::class, $formData, $formOptions);
    }

    /**
     * @return \Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider\AttributeMotherGridFormAddDataProvider
     */
    public function createAttributeMotherGridFormAddDataProvider()
    {
        return new AttributeMotherGridFormAddDataProvider(
            $this->getQueryContainer()
        );
    }

    /**
     * @return \Pyz\Zed\SizeHarmonization\Communication\Mapper\AttributeMotherGridFormTransferMapper
     */
    public function createAttributeMotherGridFormTransferMapper()
    {
        return new AttributeMotherGridFormTransferMapper();
    }
}
