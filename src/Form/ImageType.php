<?php

namespace App\Form;

use App\Entity\Work;
use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('work', EntityType::class, [
                'class' => Work::class,
                'choice_label' => 'title',
                'label' => 'Choisis ton projet'
            ])
            ->add('photoFile', VichFileType::class, [
                'required'      => false,
                'allow_delete'  => true,
                'download_uri' => true,
                'label' => false,
                'label_attr' => [
                    'class' => 'load_image_work'
                ],
                'attr' => [
                    'placeholder' => 'Enregistre un screen'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
