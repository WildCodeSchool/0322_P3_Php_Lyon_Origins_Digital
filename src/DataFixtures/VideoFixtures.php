<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VideoFixtures extends Fixture
{
    public const VIDEOS = [
        [
            'title' => '3 Minute Maokai Guide - A guide for League of Legends',
            'description' => 'Got 3 minutes spare? Why not take a quick look at how to play Maokai Jungle!
             As a tree the jungle is absolutely where Maokai belongs! Despite him being a beast at both 
             supporting and top laning his recent buffs to his clear speed allows him to tear through the jungle 
             and provide massive impact with his ganks and teamfights!',
            'post_date' => '2023-06-04 00:00:00',
            'video_url' => 'video1-LOL.mp4',
            'poster_url' => 'poster1-LOL.jpg',
        ],

        [
            'title' => '3 Minute Lux Guide - A guide for League of Legends',
            'description' => 'Got 3 minutes spare? Why not take a quick look at how to play Lux Mid Lane? 
             Lux is an easy to learn by complex to master champion who excels in controlling the map with 
             her abilities, poking away while pushing her lane before full comboing a champion back to a grey screen! 
             She\'s a threat as a support, but with the gold that mid grants she can be an absolute force!',
            'post_date' => '2023-05-31 00:00:00',
            'video_url' => 'video2-LOL.mp4',
            'poster_url' => 'poster2-LOL.jpg',
        ],

        [
            'title' => '3 Minute Katarina Guide - A guide for League of Legends',
            'description' => 'Got 3 minutes spare? Why not take a quick look at how to play Katarina Mid Lane!
             Katarina is the original blender champion - The way she jumps on champions, spins and bursts them 
             out is the true definition of a team fighting assassin!',
            'post_date' => '2023-02-01 00:00:00',
            'video_url' => 'video3-LOL.mp4',
            'poster_url' => 'poster3-LOL.jpg',
        ],

        [
            'title' => '3 Minute Samira Guide - A guide for League of Legends',
            'description' => 'Got 3 minutes spare? Why not take a quick look at how to play Samira Bot Lane!
             Samira is a truly unique carry where she relying on raw damage rather than attacking many times -
             her combo system lets her build up a ton of movement speed before penta-killing the enemy team!',
            'post_date' => '2022-12-19 00:00:00',
            'video_url' => 'video4-LOL.mp4',
            'poster_url' => 'poster4-LOL.jpg',
        ],

        [
            'title' => '3 Minute Illaoi Guide - A guide for League of Legends',
            'description' => 'Got 3 minutes spare? Why not take a quick look at how to play Illaoi Top! 
             Illaoi is a beast in the top lane coming in as a huge bruiser who loves every 1v5 situation
             she can find herself in!',
            'post_date' => '2022-09-18 00:00:00',
            'video_url' => 'video5-LOL.mp4',
            'poster_url' => 'poster5-LOL.jpg',
        ],

        [
            'title' => '3 Minute Heimerdinger Guide - A guide for League of Legends',
            'description' => 'Got 3 minutes spare? Why not take a quick look at how to play Heimerdinger Support!
             Heimerdinger has recently found himself as a unique support pick offering a ton of pushing power, 
             stuns and massaive burst damage!',
            'post_date' => '2023-05-12 00:00:00',
            'video_url' => 'video6-LOL.mp4',
            'poster_url' => 'poster6-LOL.jpg',
        ],

        [
            'title' => 'LE Guide *ULTIME* Pour AMELIORER son AIM en 2023 (Valorant)',
            'description' => 'LE Guide ULTIME Pour AVOIR un AIM PARFAIT en 2023 sur Valorant',
            'post_date' => '2023-03-25 00:00:00',
            'video_url' => 'video1-VALORANT.mp4',
            'poster_url' => 'poster1-VALORANT.jpg',
        ],

        [
            'title' => 'Comment s\'entrainer pour devenir meilleur et rank up sur valorant',
            'description' => 'Comment s\'entrainer pour devenir meilleur et rank up sur valorant',
            'post_date' => '2023-01-23 00:00:00',
            'video_url' => 'video2-VALORANT.mp4',
            'poster_url' => 'poster2-VALORANT.jpg',
        ],

        [
            'title' => 'Comment et pourquoi Bunny-hop sur Valorant',
            'description' => 'Salut à tous, aujourd\'hui je vous explique dans un tuto pourquoi 
             et comment bunny-hop sur Valorant !',
            'post_date' => '2022-07-07 00:00:00',
            'video_url' => 'video3-VALORANT.mp4',
            'poster_url' => 'poster3-VALORANT.jpg',
        ],

        [
            'title' => 'Avoir Le MEILLEUR Skin Changer Valorant en 2023 (Tutoriel Complet)',
            'description' => 'Dans cette vidéo, je vais vous montrez comment télécharger un 
             Changer Valorant en 2023 gratuitement ! C’est le premier skin changer Valorant legit.
             Le skin changer fonctionne toujours en 2023.',
            'post_date' => '2023-05-28 00:00:00',
            'video_url' => 'video4-VALORANT.mp4',
            'poster_url' => 'poster4-VALORANT.jpg',
        ],

        [
            'title' => 'Vous DEVEZ Modifier ces Paramètres sur Valorant 2023! (Meilleurs Paramètres Valorant)',
            'description' => 'Dans cette vidéo, je vais vous montrez les meilleurs paramètres de 
             Valorant en 2023 que j\'utilise pour m\'aider à rank up. Vous DEVEZ modifier ces paramètres
             si vous souhaitez améliorer votre niveaux sur Valorant et mieux viser pour rank up rapidement.',
            'post_date' => '2023-05-24 00:00:00',
            'video_url' => 'video5-VALORANT.mp4',
            'poster_url' => 'poster5-VALORANT.jpg',
        ],

        [
            'title' => 'TUTO | GAGNER DES FPS SUR VALORANT',
            'description' => 'Petit tuto sur Valorant, pour gagner en FPS et donc améliorer son niveau de jeu !',
            'post_date' => '2022-07-22 00:00:00',
            'video_url' => 'video6-VALORANT.mp4',
            'poster_url' => 'poster6-VALORANT.jpg',
        ],

        [
            'title' => 'EXPERT CHALOEIL EN 3 MINUTES - TUTORIEL DOFUS',
            'description' => 'Je vous montre dans cette vidéo comment boucler le chaloeil en 3 minutes !',
            'post_date' => '2021-08-10 00:00:00',
            'video_url' => 'video1-DOFUS.mp4',
            'poster_url' => 'poster1-DOFUS.jpg',
        ],

        [
            'title' => 'Comment apprendre à passer un donjon facilement ? Tuto Solotage Dofus',
            'description' => 'Hello ! nouvelle vidéo concernant les Solotages et l\'apprentissage des 
             donjons sur Dofus !',
            'post_date' => '2023-02-13 00:00:00',
            'video_url' => 'video2-DOFUS.mp4',
            'poster_url' => 'poster2-DOFUS.jpg',
        ],

        [
            'title' => 'DOFUS - GUIDE ULTIME CHASSEUR - EPISODE 0',
            'description' => 'Bonjour à tous bienvenue dans cette nouvelle série où je vous montre
             comment up le métier de chasseur dans Dofus! Je vais vous expliquer chaque tranche de zones, 
             où drop et comment rentabiliser le metier !',
            'post_date' => '2022-04-14 00:00:00',
            'video_url' => 'video3-DOFUS.mp4',
            'poster_url' => 'poster3-DOFUS.jpg',
        ],

    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::VIDEOS as $clip) {
            $video = new Video();
            $video->setTitle($clip['title']);
            $video->setDescription($clip['description']);
            $postDate = new DateTimeImmutable($clip['post_date']);
            $video->setPostDate($postDate);
            $video->setVideoUrl($clip['video_url']);
            $video->setPosterUrl($clip['poster_url']);
            $manager->persist($video);
        }
        $manager->flush();
    }
}
