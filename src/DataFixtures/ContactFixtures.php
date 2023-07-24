<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ContactFixtures extends Fixture implements DependentFixtureInterface
{
    public const CONTACTS = [
        "J'ai un problème lors de la connexion à mon compte utilisateur.",
        "Comment devenir moderateur de Gaming Gurus?",
        "Je n'ai pas reçu le mail de vérification lors de mon inscription.",
        "Pouvez-vous rajouter des vidéos en rapport avec Minecraft ?",
        "Je viens de remarquer un message sexiste sur la vidéo 'Le Suprême Ventoso | Smite - Rant sur Susano'"
    ];

    public function load(ObjectManager $manager): void
    {
        $maxUsersValue = (count(UserFixtures::USERS)) - 1;
        foreach (self::CONTACTS as $newContact) {
            $user = $this->getReference('user_' . rand(0, $maxUsersValue));
            $contact = new Contact();
            $contact->setUser($user);
            $contact->setEmail($user->getEmail());
            $contact->setMessage($newContact);
            $manager->persist($contact);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
