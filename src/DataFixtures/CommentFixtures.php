<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $maxVideosValue = (count(VideoFixtures::VIDEOS)) - 1;
        $maxUsersValue = (count(UserFixtures::USERS)) - 1;

        for ($i = 0; $i < 100; $i++) {
            $dateTime = $faker->dateTimeBetween('-2 months', 'now');
            $dateTimeImmutable = DateTimeImmutable::createFromMutable($dateTime);

            $comment = new Comment();
            $comment
                ->setPostDate($dateTimeImmutable)
                ->setUser($this->getReference('user_' . rand(0, $maxUsersValue)))
                ->setContent($faker->paragraph(2))
                ->setVideo($this->getReference('video_' . rand(0, $maxVideosValue)));
            $manager->persist($comment);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [VideoFixtures::class, UserFixtures::class];
    }
}
