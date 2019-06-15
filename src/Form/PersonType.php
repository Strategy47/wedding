<?php

namespace App\Form;

use App\Entity\Person;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('firstName', TextType::class, array(
                'label' => 'Prénom'
            ))
            ->add('lastName', TextType::class, array(
                'label' => 'Nom'
            ))
            ->add('birthDate', DateType::class, array(
                'label'    => 'Date de naissance',
                'required' => false,
                'years' => range(date('Y') - 90, date('Y')),
            ))
            ->add('participate', CheckboxType::class, array(
                'label'    => 'Participe',
                'required' => false
            ))
            ->add('eats', CheckboxType::class, array(
                'label'    => 'Mange',
                'required' => false
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
