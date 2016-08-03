<?php

namespace Tests;


use Doctrine\ORM\Tools\SchemaTool;
use Liip\FunctionalTestBundle\Test\WebTestCase;

/** @noinspection LongInheritanceChainInspection */
abstract class BaseTestSetup extends WebTestCase
{

    protected $client;
    protected $em;

    protected function setUp() {
        $this->em = $this->getContainer()->get('doctrine')
            ->getManager();
        if (!isset($metadatas)) {
            $metadatas = $this->em->getMetadataFactory()->getAllMetadata();
        }

        $schemaTool = new SchemaTool($this->em);
        $schemaTool->dropDatabase();

        if (!empty($metadatas)) {
            $schemaTool->createSchema($metadatas);
        }

        $this->postFixtureSetup();

        $this->client = $this->makeClient();
    }
}