<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public array $tags = [
        'lol',
        'dota',
        'fortnite',
        'cs',
        'overwatch',
        'rainbowsix',
        'valorant',
        'hearthstone',
        'smite',
        'apexlegends',
        'starcraft',
        'callofduty',
        'minecraft',
        'crossfire',
        'gearsofwar',
        'worldofwarcraft',
        'ageofempire',
        'fifa',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::$tags as $oneTag) {
            $tag = new Tag();
            $tag->setName($oneTag);
            $manager->persist($tag);
            $this->addReference('tag_' . $oneTag, $tag);
        }

        $manager->flush();
    }
}
