<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("email", EmailType::class, [
                "label" => "Email",
                "attr" => ["class" => "grow"]
            ])
            ->add("password", PasswordType::class, [
                "label" => "Heslo",
                "attr" => ["class" => "grow"]
            ]);
    }
}
