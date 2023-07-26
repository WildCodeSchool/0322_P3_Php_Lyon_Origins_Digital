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
            'email' => 'maxime@gmail.com',
            'username' => 'Maxime',
            'role' => 'ROLE_ADMIN',
            'avatar' => 'avatar-2.png'
        ],
        [
            'email' => 'frederic@gmail.com',
            'username' => 'Frederic',
            'role' => 'ROLE_ADMIN',
            'avatar' => 'avatar-3.png'
        ],
        [
            'email' => 'valentin@gmail.com',
            'username' => 'Valentin',
            'role' => 'ROLE_ADMIN',
            'avatar' => 'avatar-1.png'
        ],
        [
            'email' => 'thomas@gmail.com',
            'username' => 'Thomas',
            'role' => '',
            'avatar' => 'avatar-4.png'
        ],
        [
            'email' => 'ludovic@gmail.com',
            'username' => 'Ludovic',
            'role' => '',
            'avatar' => 'avatar-5.png'
        ],
        [
            'email' => 'Vince@gmail.com',
            'username' => 'Vince',
            'role' => '',
            'avatar' => 'avatar-6.png'
        ],
        [
            'email' => 'Leia@gmail.com',
            'username' => 'Leia',
            'role' => '',
            'avatar' => 'avatar-7.png'
        ],
        [
            'email' => 'eva@gmail.com',
            'username' => 'Eva',
            'role' => '',
            'avatar' => 'avatar-8.png'
        ],
        [
            'email' => 'Jordan@gmail.com',
            'username' => 'Jordan',
            'role' => '',
            'avatar' => 'avatar-9.png'
        ],
        [
            'email' => 'laetitia@gmail.com',
            'username' => 'Laetitia',
            'role' => '',
            'avatar' => 'avatar-10.png'
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

            $user->setAvatar($userItem['avatar']);

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
