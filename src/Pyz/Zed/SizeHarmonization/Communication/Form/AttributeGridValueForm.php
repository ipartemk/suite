<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SizeHarmonization\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @method \Pyz\Zed\SizeHarmonization\Business\SizeHarmonizationFacade getFacade()
 * @method \Pyz\Zed\SizeHarmonization\Communication\SizeHarmonizationCommunicationFactory getFactory()
 * @method \Pyz\Zed\SizeHarmonization\Persistence\SizeHarmonizationQueryContainerInterface getQueryContainer()
 * @method \Pyz\Zed\SizeHarmonization\SizeHarmonizationConfig getConfig()
 */
class AttributeGridValueForm extends AbstractType
{
    public const FIELD_VALUE = 'value';
    public const FIELD_ATTRIBUTE_MOTHER_GRID_KEY = 'fk_attribute_mother_grid_key';
    public const FIELD_ATTRIBUTE_GRID_GROUP = 'fk_attribute_grid_group';

    public const OPTION_ATTRIBUTE_MOTHER_GRID_KEY_CHOICES = 'attribute_mother_grid_key_choices';
    public const OPTION_ATTRIBUTE_GRID_GROUP_CHOICES = 'attribute_grid_group_choices';

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(static::OPTION_ATTRIBUTE_MOTHER_GRID_KEY_CHOICES);
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
        $this->addValueField($builder);
        $this->addAttributeMotherGridKeyField($builder, $options);
        $this->addAttributeGridGroupField($builder, $options);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addValueField(FormBuilderInterface $builder)
    {
        $builder
            ->add(self::FIELD_VALUE, TextType::class, [
                'label' => 'Value',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return $this
     */
    protected function addAttributeMotherGridKeyField(FormBuilderInterface $builder, array $options)
    {
        $builder->add(static::FIELD_ATTRIBUTE_MOTHER_GRID_KEY, ChoiceType::class, [
            'label' => 'Attribute mother grid Key',
            'choices' => array_flip($options[static::OPTION_ATTRIBUTE_MOTHER_GRID_KEY_CHOICES]),
            'choices_as_values' => true,
        ]);

        return $this;
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
        ]);

        return $this;
    }
}
