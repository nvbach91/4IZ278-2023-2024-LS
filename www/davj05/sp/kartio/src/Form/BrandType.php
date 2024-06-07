<?php


namespace App\Form;

use App\Document\Brand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BrandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("name", TextType::class, [
                "label" => "Název značky",
            ])
            ->add("picture", FileType::class, [
                "label" => "Obrázek značky",
                "mapped" => false,
                "required" => false,
                "attr" => ["class" => "file-input file-input-bordered w-full max-w-xs"]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            "data_class" => Brand::class,
        ]);
    }
}
