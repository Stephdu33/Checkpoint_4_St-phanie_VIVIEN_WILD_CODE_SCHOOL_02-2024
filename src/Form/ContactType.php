<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => ['placeholder' => 'Prénom'],
                'label' => false
            ])
            ->add('lastname', TextType::class, [
                'attr' => ['placeholder' => 'Nom'],
                'label' => false
            ])
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'email@email.fr'],
                'label' => false
            ])
            ->add('phonenumber', IntegerType::class, [
                'attr' => ['placeholder' => 'Numéro de téléphone'],
                'label' => false
            ])
            ->add('message', TextareaType::class, [
                'attr' => ['placeholder' => 'Veuillez saisir votre message'],
                'label' => false
            ])
            ->add('company', TextType::class, [
                'attr' => ['placeholder' => 'Nom de votre société'],
                'label' => false
            ])
            ->add('job', TextType::class, [
                'attr' => ['placeholder' => 'Votre fonction'],
                'label' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyez',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
