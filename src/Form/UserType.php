<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Mot de passe'
                ],
                'label' => false,
            ])
            ->add('roles', ChoiceType::class, [
                'multiple' => true,
                'expanded' => false,
                'choices' => [
                    'Admin' => 'ROLE_ADMIN',
                    'User' => 'ROLE_USER'
                ]
            ])
            ->add('password', PasswordType::class, [
                'attr' => [
                    'placeholder' => 'Mot de passe'
                ],
                'disabled' => true,
                'label' => false,
                'attr' => [
                    'hidden' => true,
                ]
            ])
            ->add('phonenumber', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Numéro de téléphone'
                ],
                'label' => false,
            ])
            ->add('localisation', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ma ville'
                ],
                'label' => false,
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ma description'
                ],
                'label' => false,
            ])
            ->add('job', TextType::class, [
                'attr' => [
                    'placeholder' => 'Mon poste'
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
            'data_class' => User::class,
        ]);
    }
}
