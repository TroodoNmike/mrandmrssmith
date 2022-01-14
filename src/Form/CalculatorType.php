<?php

namespace App\Form;

use App\Entity\Calculator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalculatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('entry', NumberType::class, [
                'label' => 'Calculator',
                'attr' => ['class' => 'text-end'],
            ])
            ->add('calculationType', ChoiceType::class, [
                'choices'  => [
                    0 => '+',
                    1 => '-',
                    2 => '*',
                    3 => '/',
                ],
                'mapped' => false
            ])
        ;

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            /** @var Calculator $calculator */
            $calculator = $event->getData();
            $type = $event->getForm()->get('calculationType');

            switch ($type->getData()) {
                case '+':
                    $calculator->setResult($calculator->getResult() + $calculator->getEntry());
                    break;
                case '-':
                    $calculator->setResult($calculator->getResult() - $calculator->getEntry());
                    break;
                case '*':
                    $calculator->setResult($calculator->getResult() * $calculator->getEntry());
                    break;
                case '/':
                    $calculator->setResult($calculator->getResult() / $calculator->getEntry());
                    break;
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calculator::class,
            'attr' => [
                'autocomplete' => 'off'
            ]
        ]);
    }
}
