<?php

namespace App\Tests;

use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoutingTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testRouteIsSuccessful(string $url): void
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $this->assertResponseIsSuccessful();
    }

    public function urlProvider(): mixed
    {
        yield ['/'];
        yield ['/video/show/1'];
        yield ['/search/dota'];
        yield ['/search/cs'];
        yield ['/search/overwatch'];
        yield ['/upload'];
        yield ['/user/dashboard'];
    }
}
