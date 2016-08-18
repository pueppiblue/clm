<?php

namespace AppBundle\Controller;


use AppBundle\Service\UserLootManager;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RaidController
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
     * @var UrlGeneratorInterface
     */
    private $router;
    /**
     * @var FormFactory
     */
    private $formFactory;

    /**
     * RaidController constructor.
     * @param EngineInterface $templating
     * @param UrlGeneratorInterface $router
     * @param FormFactory $formFactory
     * @param UserLootManager $userLootManager
     */
    public function __construct(
        EngineInterface $templating,
        UrlGeneratorInterface $router,
        FormFactory $formFactory,
        UserLootManager $userLootManager)
    {
        $this->userLootManager = $userLootManager;
        $this->templating = $templating;
        $this->router = $router;
        $this->formFactory = $formFactory;
    }

    /**
     * @return Response
     */
    public function showAction()
    {
        return $this->templating->renderResponse(
            ':raid:show.html.twig'
        );
    }

    /**
     * @return Response
     */
    public function listAction()
    {
        $raids = $this->userLootManager->getAllRaids();

        return $this->templating->renderResponse(
            ':raid:list.html.twig',
            ['raids' => $raids]
        );
    }

    /**
     * @return Response
     */
    public function createRosterAction()
    {
        return $this->templating->renderResponse(
            ':raid:createRoster.html.twig'
        );

    }
}
