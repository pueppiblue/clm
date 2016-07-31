<?php

namespace Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UrlAvailable extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     * @param $url
     */
    public function testPathIsAvailable($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        static::assertTrue($client->getResponse()->isSuccessful(),
            'URL: ' . $url . ' could not be reached successfully.');
    }

    /**
     * @dataProvider wildURLProvider
     * @param String $url
     */
    public function testWildCardsAreRedirected($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        static::assertTrue($client->getResponse()->isRedirection(),
            "url with wildcards was not redirected.");
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
