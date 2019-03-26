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
class AttributeMotherGridKeyForm extends AbstractType
{
    public const FIELD_KEY = 'key';
    public const FIELD_ATTRIBUTE_MOTHER_GRID = 'fk_attribute_mother_grid';

    public const OPTION_ATTRIBUTE_MOTHER_GRID_CHOICES = 'attribute_mother_grid_choices';

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(static::OPTION_ATTRIBUTE_MOTHER_GRID_CHOICES);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->addNameField($builder);
        $this->addAttributeMotherGridField($builder, $options);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addNameField(FormBuilderInterface $builder)
    {
        $builder
            ->add(self::FIELD_KEY, TextType::class, [
                'label' => 'Key',
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
    protected function addAttributeMotherGridField(FormBuilderInterface $builder, array $options)
    {
        $builder->add(static::FIELD_ATTRIBUTE_MOTHER_GRID, ChoiceType::class, [
            'label' => 'Attribute mother grid',
            'choices' => array_flip($options[static::OPTION_ATTRIBUTE_MOTHER_GRID_CHOICES]),
            'choices_as_values' => true,
        ]);

        return $this;
    }
}
