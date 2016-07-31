<?php

namespace Tests\Integration;

use Tests\BaseTestSetup;

class UserControllerTest extends BaseTestSetup
{
    /**
     * @dataProvider urlProvider
     * @param $url
     */
    public function testPathIsAvailable($url)
    {
        $this->loadFixtureFiles([
            '@AppBundle/DataFixtures/ORM/test/clmAccounts.yml',
            '@AppBundle/DataFixtures/ORM/test/clmCharacters.yml',
            '@AppBundle/DataFixtures/ORM/test/clmItems.yml',
        ]);

        $client = $this->client;
        $client->request('GET', $url);

        $this->assertStatusCode(200, $client);
    }

    /**
     * @dataProvider wildURLProvider
     * @param String $url
     */
    public function testWildCardsAreRedirected($url)
    {
        $this->loadFixtureFiles([
            '@AppBundle/DataFixtures/ORM/test/clmAccounts.yml',
            '@AppBundle/DataFixtures/ORM/test/clmCharacters.yml',
            '@AppBundle/DataFixtures/ORM/test/clmItems.yml',
        ]);

        $client = $this->client;
        $client->request('GET', $url);

        $this->assertStatusCode(302, $client);
    }

    /**
     * @return array
     */
    public function wildURLProvider()
    {
        return [
            ['/kashasjkhdaslhkd/asdasldkha'],
            ['/lsjdoasdu']
        ];
    }

    /**
     * @return array
     */
    public function urlProvider()
    {
        return [
            ['/user/list'],
            ['/user/import'],
            ['/user/show/1'],
            ['/raid/show/1'],
        ];
    }
}
