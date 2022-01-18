<?php

namespace App\Form;

use App\Service\Calculator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalculatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('entry', NumberType::class, [
                'label' => 'Calculator',
                'attr' => ['class' => 'text-end'],
                'data' => 0
            ])
            ->add('calculationType', ChoiceType::class, [
                'choices' => Calculator::CALCULATIONS_TYPES,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'attr' => [
                'autocomplete' => 'off'
            ]
        ]);
    }
}
