<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', FileType::class, [
                'attr' => ['class' => 'block w-full text-sm text-gray-700 border border-gray-300 rounded-lg p-2.5']
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold p-2 rounded']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configurez ici d'autres options par défaut si nécessaire
        ]);
    }
}
