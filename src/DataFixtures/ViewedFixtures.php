<?php

namespace App\DataFixtures;

use App\Entity\Viewed;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ViewedFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $maxValue = (count(VideoFixtures::VIDEOS)) - 1;
        for ($i = 0; $i < 100; $i++) {
            $viewed = new Viewed();
            $viewed->setUser($this->getReference('user_' . rand(0, 3)));
            $viewed->setVideo($this->getReference('video_' . rand(0, $maxValue)));
            $viewed->setViewDate(new DateTimeImmutable());
            $manager->persist($viewed);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [VideoFixtures::class, UserFixtures::class];
    }
}
