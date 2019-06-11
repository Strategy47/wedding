<?php

namespace App\Admin;

use App\Entity\Housing;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class BedRoomAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('doubleBed', NumberType::class, array(
                'label'    => "Lit double",
                'attr'     => array(
                    "placeholder" => "ex: 1",
                    "min"         => 0
                )
            ))
            ->add('singleBed', NumberType::class, array(
                'label'    => "Lit simple",
                'attr'     => array(
                    "placeholder" => "ex: 2",
                    "min"         => 0
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

