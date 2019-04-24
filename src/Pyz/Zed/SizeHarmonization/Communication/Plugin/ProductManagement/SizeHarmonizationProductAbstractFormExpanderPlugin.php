<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Plugin\ProductManagement;

use Pyz\Zed\SizeHarmonization\Communication\Form\ProductAbstractSizeHarmonizationForm;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductManagementExtension\Dependency\Plugin\ProductAbstractFormExpanderPluginInterface;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @method \Pyz\Zed\SizeHarmonization\Communication\SizeHarmonizationCommunicationFactory getFactory()
 * @method \Pyz\Zed\SizeHarmonization\SizeHarmonizationConfig getConfig()
 * @method \Pyz\Zed\SizeHarmonization\Business\SizeHarmonizationFacadeInterface getFacade()
 * @method \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainerInterface getQueryContainer()
 */
class SizeHarmonizationProductAbstractFormExpanderPlugin extends AbstractPlugin implements ProductAbstractFormExpanderPluginInterface
{
    public const FORM_SIZE_HARMONIZATION = 'size_harmonization';

    /**
     *  - Adds sub-form with SizeHarmonization relations
     *
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return \Symfony\Component\Form\FormBuilderInterface
     */
    public function expand(FormBuilderInterface $builder, array $options): FormBuilderInterface
    {
        $options = $this->getFactory()
            ->createProductAbstractSizeHarmonizationFormDataProvider()
            ->getOptions();

        $builder->add(static::FORM_SIZE_HARMONIZATION, ProductAbstractSizeHarmonizationForm::class, $options);

        return $builder;
    }
}
