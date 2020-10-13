<?php

namespace App\Form\Mailer;

use App\Entity\Mailer\Preinscription;
use App\Entity\Mailer\University;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PreinscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Nom',
                'attr'  => ['placeholder' => 'Saisir votre nom'],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Prènom',
                'attr'  => ['placeholder' => 'Saisir votre prènom'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'attr'  => ['placeholder' => 'Saisir votre adresse email'],
            ])
            ->add('faculty', TextType::class, [
                'label' => 'Filière',
                'attr'  => ['placeholder' => 'Quelle filiére voulez-vous faire ?'],
            ])
            ->add('university', EntityType::class, [
                'class' => University::class,
                'choice_label' => 'name',
                'label' => 'Université',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Preinscription::class,
        ]);
    }
}
