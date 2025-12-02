<?php
namespace App\Form;

use CommandEnums;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('commande', TextType::class, [
                'label' => 'Commande',
                'required' => true,
                'attr' => [
                    'class' => 'border border-gray-300 rounded p-2 w-full',
                    'placeholder' => 'Entrez une commande ici...', 
                ],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'inline-block bg-blue-500 hover:bg-blue-700 text-white p-2 rounded',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
