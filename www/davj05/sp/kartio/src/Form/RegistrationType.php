<?php

namespace App\Form;

use App\Document\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("email", EmailType::class, [
                "label" => "Email",
                "attr" => ["class" => "grow"],
                "constraints" => [
                    new Assert\NotBlank(),
                    new Assert\Email(),
                ],
            ])
            ->add("password", PasswordType::class, [
                "label" => "Heslo",
                "attr" => ["class" => "grow"],
                "constraints" => [
                    new Assert\NotBlank(),
                    new Assert\Length(["min" => 10]),
                ],
            ])
            ->add("role", ChoiceType::class, [
                "label" => "Role pro registraci",
                "choices" => [
                    "Zákazník" => "ROLE_USER",
                    "Obchodník" => "ROLE_ADMIN",
                ],
                "expanded" => false,
                "multiple" => false,
                "mapped" => false, // This field is not mapped to the User entity
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            "data_class" => User::class,
        ]);
    }
}
