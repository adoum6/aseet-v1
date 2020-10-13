<?php

use App\Entity\Mailer\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr'  => ['placeholder' => 'Saisir votre nom complet'] 
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'attr'  => ['placeholder' => 'Saisir votre adresse email']
            ])
            ->add('subject', TextareaType::class, [
                'label' => 'Objet du message',
                'attr'  => ['placeholder' => 'Saisir le sujet de votre message']
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'attr'  => ['placeholder' => 'Entrer votre message']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'    =>  Contact::class,
        ]);
    }
}

