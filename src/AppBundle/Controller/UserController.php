<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserImportFromFileType;
use AppBundle\Service\ClmXmlDeserializer;
use AppBundle\Service\UserLootManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UserController
{

    /**
     * @var UserLootManager
     */
    private $userLootManager;
    private $router;
    private $formFactory;

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
        UrlGeneratorInterface $router,
        FormFactory $formFactory,
        UserLootManager $userLootManager,
        ClmXmlDeserializer $xmlDeserializer)
    {
       $this->userLootManager = $userLootManager;
       $this->templating = $templating;
        $this->router = $router;
        $this->formFactory = $formFactory;
        $this->xmlDeserializer = $xmlDeserializer;
    }

    /**
     * @return Response
     */
    public function listAction()
    {
        $users =$this->userLootManager->getAllAccounts();

        return $this->templating->renderResponse(
                'User/listUsers.html.twig',
                ['users' => $users]
            );
    }
    
    public function importAction(Request $request)
    {
        $xmlFile = null;
        $form = $this->formFactory->create(UserImportFromFileType::class, $xmlFile);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $xmlFile = $form['XmlFile']->getData();
            dump($xmlFile->getClientOriginalName());
            $this->xmlDeserializer->deserializeAccounts($xmlFile);

            return new RedirectResponse(
                $this->router->generate('user_list')
            );
        }


        return $this->templating->renderResponse(
            'User/importUsers.html.twig',
            array('form' => $form->createView(),)
        );

    }
}
























