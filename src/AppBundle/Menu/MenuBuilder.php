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

        foreach ($nav->getChildren() as $child) {
            $menu->addChild($child->copy());
        }


        foreach ($user->getChildren() as $child) {
            $menu->addChild($child->copy());
        }

        return $menu;
    }

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

    public function createRaidDropButton()
    {
        $menu = $this->factory->createItem('RaidRoot');
        
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
