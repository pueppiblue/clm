<?php

namespace AppBundle\Controller;


use AppBundle\Service\UserLootManager;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RaidController
{

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

    public function showAction($id=1)
    {
        return $this->templating->renderResponse(
            ':raid:show.html.twig'
        );
        
    }
}