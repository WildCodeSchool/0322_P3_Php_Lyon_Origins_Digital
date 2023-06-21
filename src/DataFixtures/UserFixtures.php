<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public const USERS = [
        'user1@user.fr', 'user2@user.fr', 'user3@user.fr', 'user4@user.fr'
    ];

    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $count = 0;
        foreach (self::USERS as $userEmail) {
            $user = new User();
            $user->setEmail($userEmail);
            $user->setPassword($this->userPasswordHasher->hashPassword(
                $user,
                'password'
            ));
            $user->setRoles([]);
            $user->setIsVerified(true);

            $maxValue = (count(VideoFixtures::VIDEOS)) - 1;
            for ($i = 0; $i < 4; $i++) {
                $user->addFavoriteVideo($this->getReference('video_' . rand(0, $maxValue)));
                $user->addLikedVideo($this->getReference('video_' . rand(0, $maxValue)));
                $user->addViewLaterVideo($this->getReference('video_' . rand(0, $maxValue)));
            }
            $manager->persist($user);
            $this->addReference('user_' . $count, $user);
            $count++;
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [VideoFixtures::class];
    }
}
