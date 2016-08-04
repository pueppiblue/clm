<?php

namespace Tests\Integration;

use Tests\BaseTestSetup;

class UserControllerTest extends BaseTestSetup
{
    /**
     * @dataProvider unrestrictedRoutesProvider
     * @param String $url
     */
    public function testRoutesForAnonymousUser($url) {
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
    public function adminRoutesProvider()
    {
        return [
            ['/register'],
            ['/login'],
            ['/user/list'],
            ['/user/show/1'],
            ['/user/import'],
            ['/raid/show/1'],
        ];
    }

    public function userRoutesProvider()
    {
        return [
            ['/register'],
            ['/login'],
            ['/user/list'],
            ['/user/show/1'],
        ];
    }

    /**
     * @return array
     */
    public function unrestrictedRoutesProvider()
    {
        return [
            ['/register/'],
            ['/login'],
            ['/user/list'],
            ['/user/show/1'],
        ];
    }

}
