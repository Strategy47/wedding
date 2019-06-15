<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'label' => 'Identifiants',
                'help'  => "Identifiant pour la connexion"
            ))
            ->add('email', EmailType::class)
            ->add('phone', TextType::class, array(
                'required' => false,
                'label'    => 'Numéro de téléphone'
            ))
            ->add('address', TextType::class, array(
                'required' => false,
                'label'    => 'Adresse'
            ))
            ->add('zipCode', TextType::class, array(
                'required' => false,
                'label'    => 'Code postale'
            ))
            ->add('city', TextType::class, array(
                'required' => false,
                'label'    => 'Ville'
            ))
            ->add('plainPassword', TextType::class, array(
                'required' => false,
                'label'    => 'Mot de passe',
                'help'     => "Renseigner ce champ uniquement pour l'ajout ou un changement de mot de passe"
            ))
            ->add('persons', CollectionType::class, array(
                    'entry_type' => PersonType::class,
                    'label'      => 'Personnes',
                    'allow_add' => true,
                    'prototype' => true,
                    'by_reference' => false
                )
            )
            ->add('Sauvegarder', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
