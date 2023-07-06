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
        yield ['/video/add/1'];
        yield ['/search/dota'];
        yield ['/search/cs'];
        yield ['/search/overwatch'];
        yield ['/upload'];
        yield ['/viewed/1'];
        yield ['/comment/1'];
        yield ['/fav/1'];
        yield ['/later/1'];
        yield ['/login'];
        yield ['/logout'];
        yield ['/admin'];
        yield ['/register'];
        yield ['/verify/email'];
        yield ['/user/dashboard'];
        yield ['/delete/video/1'];
        yield ['/delete/user/1'];
    }
}
