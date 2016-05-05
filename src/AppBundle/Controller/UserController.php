<?php

use AppBundle\Service\UserLootManager;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

class UserController
{

    /**
     * @var UserLootManager
     */
    private $userLootManager;

    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * UserController constructor.
     * @param UserLootManager $userLootManager
     * @param EngineInterface $templating
     */
    public function __construct(UserLootManager $userLootManager, EngineInterface $templating)
    {
       $this->userLootManager = $userLootManager;
       $this->templating = $templating;
    }

    /**
     * @return Response
     */
    public function listUsersAction()
    {
        $users =$this->userLootManager->getAllUsers();

        return $this->templating->renderResponse(
                'AppBundle:User:listUsers.html.twig',
                ['users' => $users]
            );
    }
}
