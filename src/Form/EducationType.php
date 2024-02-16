<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Education;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Polyfill\Intl\Icu\DateFormat\YearTransformer;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EducationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom de la formation'
                ],
                'label' => false,
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'placeholder' => 'Description du diplôme'
                ],
                'label' => false,
            ])
            ->add('year', DateType::class, [
                'attr' => [
                    'placeholder' => 'Année du diplôme'
                ],
                'label' => false,
            ])
            ->add('school', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom de l\'Etablissement'
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
            'data_class' => Education::class,
        ]);
    }
}
