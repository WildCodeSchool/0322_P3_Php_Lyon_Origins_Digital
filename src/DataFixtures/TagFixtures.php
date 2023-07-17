<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public const TAGS = [
        'MMORPG',
        'MOBA',
        'FPS',
        'SOLO',
        'MULTIPLAYER',
        'LOL',
        'FORTNITE',
        'CS',
        'VALORANT',
        'DOFUS',
        'APEX',
        'SMITE',
        'WOW',
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
