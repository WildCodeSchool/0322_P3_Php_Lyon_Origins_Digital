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
        [
            'email' => 'user1@user.fr',
            'username' => 'Maxime',
            'role' => 'ROLE_ADMIN'
        ],
        [
            'email' => 'user2@user.fr',
            'username' => 'Frederic',
            'role' => 'ROLE_ADMIN'
        ],
        [
            'email' => 'user3@user.fr',
            'username' => 'Valentin',
            'role' => 'ROLE_ADMIN'
        ],
        [
            'email' => 'user4@user.fr',
            'username' => 'Thomas',
            'role' => ''
        ],
        [
            'email' => 'user5@user.fr',
            'username' => 'Robert',
            'role' => ''
        ],
        [
            'email' => 'user6@user.fr',
            'username' => 'Ferdinand',
            'role' => ''
        ],
        [
            'email' => 'user7@user.fr',
            'username' => 'Roland',
            'role' => ''
        ],
        [
            'email' => 'user8@user.fr',
            'username' => 'Jocelyne',
            'role' => ''
        ],
        [
            'email' => 'user9@user.fr',
            'username' => 'Marcelle',
            'role' => ''
        ],
        [
            'email' => 'user10@user.fr',
            'username' => 'Brigitte',
            'role' => ''
        ],
        [
            'email' => 'user11@user.fr',
            'username' => 'Yvette',
            'role' => ''
        ],
    ];

    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $count = 0;
        foreach (self::USERS as $userItem) {
            $user = new User();
            $user->setEmail($userItem['email']);
            $user->setUsername($userItem['username']);
            $user->setPassword($this->userPasswordHasher->hashPassword(
                $user,
                'password'
            ));
            $user->setRoles([$userItem['role']]);
            if ($userItem['role'] == 'ROLE_ADMIN') {
                $user->setIsAdmin(true);
            } else {
                $user->setIsAdmin(false);
            }

            $user->setIsVerified(true);

            $maxValue = (count(VideoFixtures::VIDEOS)) - 1;
            for ($i = 0; $i < rand(5, 10); $i++) {
                $user->addFavoriteVideo($this->getReference('video_' . rand(0, $maxValue)));
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
