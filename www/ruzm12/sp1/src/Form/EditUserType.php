<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Zákazník ' => 'ROLE_USER',
                    'Admin ' => 'ROLE_ADMIN',
                    'Pokladník' => 'ROLE_CASHIER',
                ],
                'expanded' => true,
                'multiple' => true
            ])
            ->add('firstName')
            ->add('lastName');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
