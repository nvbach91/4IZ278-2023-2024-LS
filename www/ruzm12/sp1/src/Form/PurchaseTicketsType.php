<?php

namespace App\Form;

use App\Entity\Ticket;
use App\Entity\Entrance;
use App\Entity\FootballMatch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PurchaseTicketsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numberOfAdultTickets', IntegerType::class, [
                'label' => 'Počet vstupenek pro dospělé',
                'attr' => [
                    'min' => 0,
                    'max' => 10,
                ],
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new NotNull(),
                    new Type('integer'),
                ],
            ])
            ->add('numberOfChildTickets', IntegerType::class, [
                'label' => 'Počet vstupenek pro děti',
                'attr' => [
                    'min' => 0,
                    'max' => 10,
                ],
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new NotNull(),
                    new Type('integer'),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}
