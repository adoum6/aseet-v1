<?php

namespace App\Form\Mailer;

use App\Entity\Mailer\Demande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label'  =>  'Nom',
                'attr'   =>  ['placeholder' => 'Saisir votre nom'],
            ])
            ->add('lastName', TextType::class, [
                'label'  =>  'Prènom',
                'attr'   =>  ['placeholder' => 'Entrer votre prènom'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'attr'  => ['placeholder' => 'Entrer votre adresse email'],
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Numéro de Téléphone',
                'attr'  => ['placeholder' => 'Votre numéro de téléphone'],
            ])
            ->add('address', TextType::class, [
                'label'  =>  'Adresse',
                'attr'   =>  ['placeholder' => 'Où habitez vous ?'],
            ])
            ->add('establishment', TextType::class, [
                'label' => 'Etablissement',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
    }
}
