<?php

namespace AppBundle\Menu;

use AppBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

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
     * @var AuthorizationCheckerInterface
     */
    private $checker;

    /**
     * MenuBuilder constructor.
     * @param FactoryInterface $factory
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(FactoryInterface $factory, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->factory = $factory;
        $this->checker = $authorizationChecker;
    }

    /**
     * @return ItemInterface
     * @throws InvalidArgumentException
     */
    public function createNavMenu()
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'left hide-on-med-and-down');

        $menu->addChild('Accounts', array('route' => 'user_list'));
        $menu['Accounts']->setAttribute('class', 'hoverable waves-effect waves-light');

        $menu->addChild('Import xml', array('route' => 'user_import'));
        $menu['Import xml']->setAttribute('class', 'hoverable waves-effect waves-light');

        $menu->addChild('Raid', ['uri' => '#']);
        $menu['Raid']->setLinkAttribute('data-activates', 'dropdown-raid');
        $menu['Raid']->setLinkAttribute('class', 'dropdown-button');

        $menuDrop = $menu->addChild('');
        $menuDrop->setChildrenAttributes([
            'class' => 'dropdown-content',
            'id' => 'dropdown-raid'
        ]);

        $menuDrop->addChild('List Raids', ['route' => 'raid_list']);
        $menuDrop['List Raids']->setAttribute('class', 'hoverable waves-effect waves-light');

        $menuDrop->addChild('Create Raid', ['route' => 'raid_createRoster']);
        $menuDrop['Create Raid']->setAttribute('class', 'hoverable waves-effect waves-light');

        $menuDrop->addChild('Active Raids', ['route' => 'raid_list']);
        $menuDrop['Active Raids']->setAttribute('class', 'hoverable waves-effect waves-light');

        return $menu;
    }

    /**
     * @param $options
     * @return ItemInterface
     * @throws InvalidArgumentException
     */
    public function createSideMenu($options)
    {
        $menu = $this->factory->createItem('sideRoot');
        $menu->setChildrenAttribute('class', 'side-nav');
        $menu->setChildrenAttribute('id', 'mobile-nav');

        $user = $this->createUserMenu($options);
        $nav = $this->createNavMenu();

        /*import all nav menu items except 'raid'
        because dropdown is converted to collapsible in side menu*/
        foreach ($nav->getChildren() as $child) {
            if($child->getLabel()!=='Raid') {
                $menu->addChild($child->copy());
            }
        }

        // include raidDropDown as collapsible
        $raidMenu= $menu->addChild('',['attributes' => ['class' => 'no-padding']]);

        //$raidMenu = $this->factory->createItem('raidSideMenu');
        $raidMenu->setChildrenAttribute('class', 'collapsible collapsible-accordion');

        $raidDropDown = $raidMenu->addChild('Raid', ['uri' => '#']);
        $raidDropDown->setLinkAttribute('class', 'collapsible-header');
        $raidDropDown->setChildrenAttribute('class', 'collapsible-body');

        $raidDropDown->addChild('Create Raid', ['uri' => '#']);
        $raidDropDown->addChild('List Raids', ['uri' => '#']);
        $raidDropDown->addChild('Active Raids', ['uri' => '#']);

        //copy user menu
        foreach ($user->getChildren() as $child) {
            $menu->addChild($child->copy());
        }


        return $menu;
    }

    /**
     * @return ItemInterface
     * deprecated logic included in navMenu fucntion
     */
    public function createRaidDropContent()
    {
        $menu = $this->factory->createItem('RaidContent');
        $menu->setChildrenAttributes([
            'class' => 'dropdown-content',
            'id' => 'dropdown-raid'
        ]);

        $menu->addChild('Raid List', ['route' => 'raid_list']);
        $menu['Raid List']->setAttribute('class', 'hoverable waves-effect waves-light');

        $menu->addChild('Create Roster', ['route' => 'raid_createRoster']);
        $menu['Create Roster']->setAttribute('class', 'hoverable waves-effect waves-light');

        return $menu;

    }

    /**
     * @return ItemInterface
     * deprecated logic included in navMenu fucntion
     */
    public function createRaidDropButton()
    {
        $menu = $this->factory->createItem('RaidRoot');
        $menu->setChildrenAttribute('class', 'right hide-on-med-and-down');
        $menu->addChild('Raid', ['uri' => '#']);
        $menu['Raid']->setLinkAttribute('data-activates', 'dropdown-raid');
        $menu['Raid']->setLinkAttribute('class', 'dropdown-button');
        
        return $menu;
    }

    /**
     * @param array $options
     * @return ItemInterface
     * @throws InvalidArgumentException
     */
    public function createUserMenu(array $options)
    {
        $isAdmin = $this->checker->isGranted('ROLE_ADMIN');
        $isUser = $this->checker->isGranted('ROLE_USER');
        $isLoggedIn = ($isAdmin || $isUser);

        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'right hide-on-med-and-down')
            ->setExtra('translation_domain', 'FOSUserBundle');

        if ($isLoggedIn) {
            /** @var User $user */
            $user = $options['user'];
            $userName = $user->getUsername();
            $menu->addChild('Logout('.$userName.')',['route' => 'fos_user_security_logout']);
        } else {
            $menu->addChild('Login', ['route' => 'fos_user_security_login'])
                ->setExtra('translation_domain', 'FOSUserBundle');

            $menu->addChild('Register', ['route' => 'fos_user_registration_register']);
        }

        return $menu;
    }
}
