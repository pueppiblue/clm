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
        $menu->setChildrenAttribute('class', 'left hide-on-med-and-down');

        $menu->addChild('Accounts', array('route' => 'user_list'));
        $menu['Accounts']->setAttribute('class', 'hoverable waves-effect waves-light');
        $menu->addChild('Raid', array('route' => 'user_list'));
        $menu['Raid']->setAttribute('class', 'hoverable waves-effect waves-light');
        $menu->addChild('Import xml', array('route' => 'user_import'));
        $menu['Import xml']->setAttribute('class', 'hoverable waves-effect waves-light');

        return $menu;

    }

    public function createSideMenu()
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'side-nav');
        $menu->setChildrenAttribute('id', 'mobile-nav');

        $menu->addChild('Accounts', array('route' => 'user_list'));
        $menu['Accounts']->setAttribute('class', 'hoverable waves-effect waves-light');
        $menu->addChild('Raid', array('route' => 'user_list'));
        $menu['Raid']->setAttribute('class', 'hoverable waves-effect waves-light');
        $menu->addChild('Import xml', array('route' => 'user_import'));
        $menu['Import xml']->setAttribute('class', 'hoverable waves-effect waves-light');

        return $menu;

    }
}