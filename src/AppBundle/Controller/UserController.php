<?php

namespace AppBundle\Controller;

use AppBundle\Service\UserLootManager;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Service\ClmXmlDeserializer;

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
    private $xmlDeserializer;

    /**
     * UserController constructor.
     * @param UserLootManager $userLootManager
     * @param EngineInterface $templating
     */
    public function __construct(
        EngineInterface $templating,
        UserLootManager $userLootManager,
        ClmXmlDeserializer $xmlDeserializer)
    {
       $this->userLootManager = $userLootManager;
       $this->templating = $templating;
        $this->xmlDeserializer = $xmlDeserializer;
    }

    /**
     * @return Response
     */
    public function listUsersAction()
    {
        $users =$this->userLootManager->getAllUsers();

        $this->xmlDeserializer->deserializeAccounts();

        return $this->templating->renderResponse(
                'User/listUsers.html.twig',
                ['users' => $users]
            );
    }
}
