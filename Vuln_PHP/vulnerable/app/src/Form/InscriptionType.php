<?php

namespace App\Form;

use App\Entity\Inscription;
use App\Entity\Lycee;
use App\Entity\Section;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('telephone')
            ->add('nom')
            ->add('prenom')
            ->add('lycee', EntityType::class, [
                'class' => Lycee::class,
                'choice_label' => 'nom',
                'placeholder' => '-- Sélectionner un lycée --',
                'placeholder_attr' => [
                    'disabled' => '',
                ],
            ])
            ->add('section', EntityType::class, [
                'class' => Section::class,
                'choice_label' => 'nom',
                'placeholder' => '-- Sélectionner une section --',
                'placeholder_attr' => [
                    'disabled' => '',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
