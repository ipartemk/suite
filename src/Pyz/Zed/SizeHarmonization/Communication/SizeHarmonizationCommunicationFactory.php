<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication;

use Pyz\Zed\SizeHarmonization\Communication\Form\AttributeGridGroupForm;
use Pyz\Zed\SizeHarmonization\Communication\Form\AttributeGridValueForm;
use Pyz\Zed\SizeHarmonization\Communication\Form\AttributeMotherGridColForm;
use Pyz\Zed\SizeHarmonization\Communication\Form\AttributeMotherGridForm;
use Pyz\Zed\SizeHarmonization\Communication\Form\AttributeMotherGridKeyForm;
use Pyz\Zed\SizeHarmonization\Communication\Form\AttributeMotherGridValueForm;
use Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider\AttributeGridGroupFormDataProvider;
use Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider\AttributeGridValueFormDataProvider;
use Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider\AttributeMotherGridColFormDataProvider;
use Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider\AttributeMotherGridFormDataProvider;
use Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider\AttributeMotherGridKeyFormDataProvider;
use Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider\AttributeMotherGridValueFormDataProvider;
use Pyz\Zed\SizeHarmonization\Communication\Mapper\AttributeGridGroupFormTransferMapper;
use Pyz\Zed\SizeHarmonization\Communication\Mapper\AttributeGridValueFormTransferMapper;
use Pyz\Zed\SizeHarmonization\Communication\Mapper\AttributeMotherGridColFormTransferMapper;
use Pyz\Zed\SizeHarmonization\Communication\Mapper\AttributeMotherGridFormTransferMapper;
use Pyz\Zed\SizeHarmonization\Communication\Mapper\AttributeMotherGridKeyFormTransferMapper;
use Pyz\Zed\SizeHarmonization\Communication\Mapper\AttributeMotherGridValueFormTransferMapper;
use Pyz\Zed\SizeHarmonization\Communication\Table\AttributeGridGroupTable;
use Pyz\Zed\SizeHarmonization\Communication\Table\AttributeGridValueTable;
use Pyz\Zed\SizeHarmonization\Communication\Table\AttributeMotherGridColTable;
use Pyz\Zed\SizeHarmonization\Communication\Table\AttributeMotherGridKeyTable;
use Pyz\Zed\SizeHarmonization\Communication\Table\AttributeMotherGridTable;
use Pyz\Zed\SizeHarmonization\Communication\Table\AttributeMotherGridValueTable;
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
    public function createAttributeMotherGridColTable()
    {
        return new AttributeMotherGridColTable(
            $this->getQueryContainer()
        );
    }

    /**
     * @param array $formData
     * @param array $formOptions
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createAttributeMotherGridColForm(array $formData, array $formOptions = [])
    {
        return $this->getFormFactory()->create(AttributeMotherGridColForm::class, $formData, $formOptions);
    }

    /**
     * @return \Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider\AttributeMotherGridColFormDataProvider
     */
    public function createAttributeMotherGridColFormDataProvider()
    {
        return new AttributeMotherGridColFormDataProvider(
            $this->getQueryContainer()
        );
    }

    /**
     * @return \Pyz\Zed\SizeHarmonization\Communication\Mapper\AttributeMotherGridColFormTransferMapper
     */
    public function createAttributeMotherGridColFormTransferMapper()
    {
        return new AttributeMotherGridColFormTransferMapper();
    }

    /**
     * @return \Spryker\Zed\Gui\Communication\Table\AbstractTable
     */
    public function createAttributeMotherGridValueTable()
    {
        return new AttributeMotherGridValueTable(
            $this->getQueryContainer()
        );
    }

    /**
     * @param array $formData
     * @param array $formOptions
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createAttributeMotherGridValueForm(array $formData, array $formOptions = [])
    {
        return $this->getFormFactory()->create(AttributeMotherGridValueForm::class, $formData, $formOptions);
    }

    /**
     * @return \Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider\AttributeMotherGridValueFormDataProvider
     */
    public function createAttributeMotherGridValueFormDataProvider()
    {
        return new AttributeMotherGridValueFormDataProvider(
            $this->getQueryContainer()
        );
    }

    /**
     * @return \Pyz\Zed\SizeHarmonization\Communication\Mapper\AttributeMotherGridValueFormTransferMapper
     */
    public function createAttributeMotherGridValueFormTransferMapper()
    {
        return new AttributeMotherGridValueFormTransferMapper();
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

    /**
     * @return \Spryker\Zed\Gui\Communication\Table\AbstractTable
     */
    public function createAttributeGridValueTable()
    {
        return new AttributeGridValueTable(
            $this->getQueryContainer()
        );
    }

    /**
     * @param array $formData
     * @param array $formOptions
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createAttributeGridValueForm(array $formData, array $formOptions = [])
    {
        return $this->getFormFactory()->create(AttributeGridValueForm::class, $formData, $formOptions);
    }

    /**
     * @return \Pyz\Zed\SizeHarmonization\Communication\Form\DataProvider\AttributeGridValueFormDataProvider
     */
    public function createAttributeGridValueFormDataProvider()
    {
        return new AttributeGridValueFormDataProvider(
            $this->getQueryContainer()
        );
    }

    /**
     * @return \Pyz\Zed\SizeHarmonization\Communication\Mapper\AttributeGridValueFormTransferMapper
     */
    public function createAttributeGridValueFormTransferMapper()
    {
        return new AttributeGridValueFormTransferMapper();
    }
}
