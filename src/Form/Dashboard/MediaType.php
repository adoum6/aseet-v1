<?php

namespace App\Form\Activity;

use App\Entity\Activity\Category;
use App\Entity\Activity\Media;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mediaFile', VichImageType::class, [
                'required'  => false,
                'label'     => 'Choisir un média',
                'allow_delete' => true,
                'download_uri' => false,
            ])
            ->add('category', EntityType::class, [
                'class' =>  Category::class,
                'choice_label'  =>  'label',
                'label' =>  'Catégorie',
            ])
            ->add('date')
            ->add('year')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}
