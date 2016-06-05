<?php

namespace AppBundle\Menu;


use Knp\Menu\FactoryInterface;

/**
 * Class MenuBuilder
 * @package AppBundle\Menu
 */
class MenuBuilder
{
    /**
     * @var FactoryInterface
     */
    private $factory;


    /**
     * MenuBuilder constructor.
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return \Knp\Menu\ItemInterface
     */
    public function createNavMenu()
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Accounts', array('route' => 'user_list'));
        $menu->addChild('Raid', array('route' => ''));
        $menu->addChild('Import xml', array('route' => 'user_import'));
        
        return $menu;
    }
}