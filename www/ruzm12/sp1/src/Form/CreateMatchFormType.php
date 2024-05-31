<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Ticket;
use App\Entity\FootballMatch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;

class CreateMatchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Název zápasu',
                'required' => true,
                'constraints' => [
                    new NotNull(),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'Název zápasu může mít maximálně 255 znaků'
                    ])
                ]
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Plánovaný' => 'Plánovaný',
                    'Probíhající' => 'Probíhající',
                    'Ukončený' => 'Ukončený',
                ],
                'required' => true,
                'constraints' => [
                    new NotNull(),
                    new Choice([
                        'choices' => ['Plánovaný', 'Probíhající', 'Ukončený'],
                        'message' => 'Vyberte stav zápasu'
                    ])
                ]
            ])
            ->add('played_at', null, [
                'widget' => 'single_text',
                'required' => true,
                'constraints' => [
                    new NotNull()
                ]
            ])
            ->add('full_price', null, [
                'label' => 'Cena plného vstupného',
                'constraints' => [
                    new Type([
                        'type' => 'numeric',
                        'message' => 'Cena musí být číslo',

                    ]),
                    new NotNull()
                ],
                'required' => true,
                'invalid_message' => 'Cena musí být číslo'
            ])
            ->add('child_price', null, [
                'label' => 'Cena dětského vstupného',
                'constraints' => [
                    new Type([
                        'type' => 'numeric',
                        'message' => 'Cena musí být číslo'
                    ]),
                    new NotNull()
                ],
                'required' => true,
                'invalid_message' => 'Cena musí být číslo'
            ])
            ->add('availability', ChoiceType::class, [
                'choices' => [
                    'Ano' => true,
                    'Ne' => false
                ],
                'required' => true,
                'constraints' => [
                    new NotNull(),
                    new Choice([
                        'choices' => [true, false],
                        'message' => 'Vyberte dostupnost vstupenek'
                    ])
                ]

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FootballMatch::class,
        ]);
    }
}
