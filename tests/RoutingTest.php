<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoutingTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testRouteIsSuccessful($url): void
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $this->assertResponseIsSuccessful();
    }

    public function urlProvider()
    {
        yield ['/'];
        // yield ['/video/show/454'];
        // yield ['/video/show/471'];
        yield ['/video/show/505'];
        yield ['/search/dota'];
        yield ['/search/cs'];
        yield ['/search/overwatch'];
        // yield ['/search/upload'];
    }
}
