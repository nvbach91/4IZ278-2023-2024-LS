<?php

namespace App\Form;

use App\Document\LoyaltyCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class LoyaltyCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("customerName", TextType::class, [
                "label" => "Jméno zákazníka",
                "attr" => ["class" => "grow"],
                "constraints" => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add("email", EmailType::class, [
                "label" => "Email",
                "attr" => ["class" => "grow"],
                "constraints" => [
                    new Assert\NotBlank(),
                    new Assert\Email(),
                ],
            ])
            ->add("phoneNumber", TextType::class, [
                "label" => "Telefonní číslo",
                "attr" => ["class" => "grow"],
                "constraints" => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add("cardIdentifier", TextType::class, [
                "label" => "ID Karty",
                "attr" => ["class" => "grow"],
                "required" => false,
                "constraints" => [
                    new Assert\NotBlank(),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            "data_class" => LoyaltyCard::class,
        ]);
    }
}
