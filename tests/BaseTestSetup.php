<?php

namespace Tests;


use Doctrine\ORM\Tools\SchemaTool;
use Liip\FunctionalTestBundle\Test\WebTestCase;

abstract class BaseTestSetup extends WebTestCase
{

    private $client;
    private $em;

    protected function setUp() {
        $this->client = static::createClient();
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
    }
}