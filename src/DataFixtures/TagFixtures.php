<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public const TAGS = [
        'lol',
        'DOTA',
        'FORTNITE',
        'CS',
        'OVERWATCH',
        'RAINBOWSIX',
        'VALORANT',
        'HEARTHSTONE',
        'SMITE',
        'APEXLEGENDS',
        'STARCRAFT',
        'CALLOFDUTY',
        'MINECRAFT',
        'CROSSFIRE',
        'GEARSOFWAR',
        'WORLDOFWARCRAFT',
        'AGEOFEMPIRE',
        'FIFA',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TAGS as $oneTag) {
            $tag = new Tag();
            $tag->setName($oneTag);
            $manager->persist($tag);
            $this->addReference('tag_' . $oneTag, $tag);
        }
        $manager->flush();
    }
}
