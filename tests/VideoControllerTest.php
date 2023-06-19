<?php

namespace App\Tests;

use Symfony\Component\Panther\PantherTestCase;

class VideoControllerTest extends PantherTestCase
{
    public function testVideoController(): void
    {
        $client = static::createPantherClient(array_replace(static::$defaultOptions, ['port' => 8001]));
        $crawler = $client->request('GET', '/video/show/1');

        $this->assertSelectorExists('#player');
    }
}
