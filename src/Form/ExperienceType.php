<?php

namespace App\Form;

use App\Entity\Experience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('company', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom de l\'entreprise'
                ],
                'label' => false,
            ])
            ->add('job', TextType::class, [
                'attr' => [
                    'placeholder' => 'Poste occupé'
                ],
                'label' => false,
            ])
            ->add('startyear', DateType::class, [
                'attr' => [
                    'placeholder' => 'Date de début'
                ],
                'label' => false,
            ])
            ->add('endyear', DateType::class, [
                'attr' => [
                    'placeholder' => 'Date de fin'
                ],
                'label' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
