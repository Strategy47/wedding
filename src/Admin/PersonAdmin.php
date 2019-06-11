<?php

namespace App\Admin;

use App\Entity\User;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PersonAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('firstName', TextType::class, array(
                'label' => 'Prénom'
            ))
            ->add('lastName', TextType::class, array(
                'label' => 'Nom de famille'
            ))
            ->add('birthDate', BirthdayType::class, array(
                "widget"  => "choice",
                "label"   => "Date de naissance"
            ))
            ->add('user', EntityType::class, array(
                'class' => User::class,
                'label' => 'Famille',
                'choice_label'  => function(User $user) {
                    return sprintf("%s (%s %s)",
                        $user->getUsername(),
                        $user->getZipCode(),
                        $user->getCity()
                    );
                }
            ))
            ->add('participate', ChoiceType::class, array(
                'label' => 'Présent au mariage',
                'choices' => array(
                    'oui' => true,
                    'non' => false
                )
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('firstName')
            ->add('lastName')
            ->add('user')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('firstName')
            ->addIdentifier('lastName')
            ->add('birthDate')
            ->add('user')
        ;
    }
}

