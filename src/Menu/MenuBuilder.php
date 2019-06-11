<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('main', array(
            'childrenAttributes' => array(
                'class' => 'list-item'
            ),
        ));

        $menu->addChild('Accueil', array('route' => 'homepage'));
        $menu->addChild('Contact', array('route' => 'contact'));

        return $menu;
    }
}
