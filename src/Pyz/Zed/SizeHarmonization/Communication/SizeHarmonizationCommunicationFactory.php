<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication;

use Pyz\Zed\SizeHarmonization\Communication\Form\AttributeGridGroupForm;
use Pyz\Zed\SizeHarmonization\Communication\Form\AttributeMotherGridForm;
use Pyz\Zed\SizeHarmonization\Communication\Form\AttributeMotherGridKeyForm;
use Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider\AttributeGridGroupFormDataProvider;
use Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider\AttributeMotherGridFormDataProvider;
use Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider\AttributeMotherGridKeyFormDataProvider;
use Pyz\Zed\SizeHarmonization\Communication\Mapper\AttributeGridGroupFormTransferMapper;
use Pyz\Zed\SizeHarmonization\Communication\Mapper\AttributeMotherGridFormTransferMapper;
use Pyz\Zed\SizeHarmonization\Communication\Mapper\AttributeMotherGridKeyFormTransferMapper;
use Pyz\Zed\SizeHarmonization\Communication\Table\AttributeGridGroupTable;
use Pyz\Zed\SizeHarmonization\Communication\Table\AttributeMotherGridKeyTable;
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
    public function createAttributeMotherGridForm(array $formData, array $formOptions = [])
    {
        return $this->getFormFactory()->create(AttributeMotherGridForm::class, $formData, $formOptions);
    }

    /**
     * @return \Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider\AttributeMotherGridFormDataProvider
     */
    public function createAttributeMotherGridFormDataProvider()
    {
        return new AttributeMotherGridFormDataProvider(
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

    /**
     * @return \Spryker\Zed\Gui\Communication\Table\AbstractTable
     */
    public function createAttributeMotherGridKeyTable()
    {
        return new AttributeMotherGridKeyTable(
            $this->getQueryContainer()
        );
    }

    /**
     * @param array $formData
     * @param array $formOptions
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createAttributeMotherGridKeyForm(array $formData, array $formOptions = [])
    {
        return $this->getFormFactory()->create(AttributeMotherGridKeyForm::class, $formData, $formOptions);
    }

    /**
     * @return \Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider\AttributeMotherGridKeyFormDataProvider
     */
    public function createAttributeMotherGridKeyFormDataProvider()
    {
        return new AttributeMotherGridKeyFormDataProvider(
            $this->getQueryContainer()
        );
    }

    /**
     * @return \Pyz\Zed\SizeHarmonization\Communication\Mapper\AttributeMotherGridKeyFormTransferMapper
     */
    public function createAttributeMotherGridKeyFormTransferMapper()
    {
        return new AttributeMotherGridKeyFormTransferMapper();
    }

    /**
     * @return \Spryker\Zed\Gui\Communication\Table\AbstractTable
     */
    public function createAttributeGridGroupTable()
    {
        return new AttributeGridGroupTable(
            $this->getQueryContainer()
        );
    }

    /**
     * @param array $formData
     * @param array $formOptions
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createAttributeGridGroupForm(array $formData, array $formOptions = [])
    {
        return $this->getFormFactory()->create(AttributeGridGroupForm::class, $formData, $formOptions);
    }

    /**
     * @return \Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider\AttributeGridGroupFormDataProvider
     */
    public function createAttributeGridGroupFormDataProvider()
    {
        return new AttributeGridGroupFormDataProvider(
            $this->getQueryContainer()
        );
    }

    /**
     * @return \Pyz\Zed\SizeHarmonization\Communication\Mapper\AttributeGridGroupFormTransferMapper
     */
    public function createAttributeGridGroupFormTransferMapper()
    {
        return new AttributeGridGroupFormTransferMapper();
    }
}
