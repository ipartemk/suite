<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method \Pyz\Zed\SizeHarmonization\Business\SizeHarmonizationFacade getFacade()
 * @method \Pyz\Zed\SizeHarmonization\Communication\SizeHarmonizationCommunicationFactory getFactory()
 * @method \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainerInterface getQueryContainer()
 * @method \Pyz\Zed\SizeHarmonization\SizeHarmonizationConfig getConfig()
 */
class ProductAbstractSizeHarmonizationForm extends AbstractType
{
    public const FIELD_ATTRIBUTE_GRID_GROUP = 'fk_attribute_grid_group';

    public const OPTION_ATTRIBUTE_GRID_GROUP_CHOICES = 'attribute_grid_group_choices';

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(static::OPTION_ATTRIBUTE_GRID_GROUP_CHOICES);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->addAttributeGridGroupField($builder, $options);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return $this
     */
    protected function addAttributeGridGroupField(FormBuilderInterface $builder, array $options)
    {
        $builder->add(static::FIELD_ATTRIBUTE_GRID_GROUP, ChoiceType::class, [
            'label' => 'Attribute grid Group',
            'choices' => array_flip($options[static::OPTION_ATTRIBUTE_GRID_GROUP_CHOICES]),
            'choices_as_values' => true,
            'required' => false,
        ]);

        return $this;
    }
}
