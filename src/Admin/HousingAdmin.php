<?php

namespace App\Admin;

use App\Entity\Housing;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Sonata\CoreBundle\Form\Type\CollectionType;

class HousingAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('type', ChoiceType::class, array(
                'label'       => 'Type',
                'placeholder' => "Type d'hébergement",
                'required'    => true,
                'choices'     => array(
                    ucfirst(Housing::TYPE[0]) => Housing::TYPE[0],
                    ucfirst(Housing::TYPE[1]) => Housing::TYPE[1]
                )
            ))
            ->add('price', NumberType::class, array(
                'label'    => "Prix",
                'attr'     => array(
                    "placeholder" => "ex: 625.25",
                    "step"        => 0.01,
                    "min"         => 0
                )
            ))
            ->add('bedRooms', CollectionType::class, array(
                'label' => false,
                'required' => false,
                'by_reference' => false,
                'type_options' => array(
                    'delete' => true,
                    'delete_options' => array(
                        'type'         => CheckboxType::class,
                        'type_options' => array(
                            'mapped'   => false,
                            'required' => true,
                        )
                    )
                )
            ),
                array(
                    'edit' => 'inline',
                    'inline' => 'natural',
                    'sortable' => 'id'
                )
            )
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('type')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('type')
            ->addIdentifier('price')
            ->add('capacity')
        ;
    }
}

