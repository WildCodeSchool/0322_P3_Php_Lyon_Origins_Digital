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
            'role' => 'ROLE_ADMIN'
        ],
        [
            'email' => 'frederic@gmail.com',
            'username' => 'Frederic',
            'role' => 'ROLE_ADMIN'
        ],
        [
            'email' => 'valentin@gmail.com',
            'username' => 'Valentin',
            'role' => 'ROLE_ADMIN'
        ],
        [
            'email' => 'thomas@gmail.com',
            'username' => 'Thomas',
            'role' => ''
        ],
        [
            'email' => 'ludovic@gmail.com',
            'username' => 'Ludovic',
            'role' => ''
        ],
        [
            'email' => 'anthony@gmail.com',
            'username' => 'Anthony',
            'role' => ''
        ],
        [
            'email' => 'aurelien@gmail.com',
            'username' => 'Aurélien',
            'role' => ''
        ],
        [
            'email' => 'baptiste@gmail.com',
            'username' => 'Baptiste',
            'role' => ''
        ],
        [
            'email' => 'benjamin@gmail.com',
            'username' => 'Benjamin',
            'role' => ''
        ],
        [
            'email' => 'laetitia@gmail.com',
            'username' => 'Laetitia',
            'role' => ''
        ],
        [
            'email' => 'mouhamed@gmail.com',
            'username' => 'Mouhamed',
            'role' => ''
        ],
        [
            'email' => 'axel@gmail.com',
            'username' => 'Axel',
            'role' => ''
        ],
        [
            'email' => 'zakaria@gmail.com',
            'username' => 'Zakaria',
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
