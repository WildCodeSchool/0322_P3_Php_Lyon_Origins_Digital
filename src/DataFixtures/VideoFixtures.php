<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VideoFixtures extends Fixture implements DependentFixtureInterface
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
            'is_header' => false,
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
            'is_header' => false,
        ],

        [
            'title' => '3 Minute Katarina Guide - A guide for League of Legends',
            'description' => 'Got 3 minutes spare? Why not take a quick look at how to play Katarina Mid Lane!
             Katarina is the original blender champion - The way she jumps on champions, spins and bursts them 
             out is the true definition of a team fighting assassin!',
            'post_date' => '2023-02-01 00:00:00',
            'video_url' => 'video3-LOL.mp4',
            'poster_url' => 'poster3-LOL.jpg',
            'is_header' => false,
        ],

        [
            'title' => '3 Minute Samira Guide - A guide for League of Legends',
            'description' => 'Got 3 minutes spare? Why not take a quick look at how to play Samira Bot Lane!
             Samira is a truly unique carry where she relying on raw damage rather than attacking many times -
             her combo system lets her build up a ton of movement speed before penta-killing the enemy team!',
            'post_date' => '2022-12-19 00:00:00',
            'video_url' => 'video4-LOL.mp4',
            'poster_url' => 'poster4-LOL.jpg',
            'is_header' => false,
        ],

        [
            'title' => '3 Minute Illaoi Guide - A guide for League of Legends',
            'description' => 'Got 3 minutes spare? Why not take a quick look at how to play Illaoi Top! 
             Illaoi is a beast in the top lane coming in as a huge bruiser who loves every 1v5 situation
             she can find herself in!',
            'post_date' => '2022-09-18 00:00:00',
            'video_url' => 'video5-LOL.mp4',
            'poster_url' => 'poster5-LOL.jpg',
            'is_header' => false,
        ],

        [
            'title' => '3 Minute Heimerdinger Guide - A guide for League of Legends',
            'description' => 'Got 3 minutes spare? Why not take a quick look at how to play Heimerdinger Support!
             Heimerdinger has recently found himself as a unique support pick offering a ton of pushing power, 
             stuns and massaive burst damage!',
            'post_date' => '2023-05-12 00:00:00',
            'video_url' => 'video6-LOL.mp4',
            'poster_url' => 'poster6-LOL.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'LE Guide *ULTIME* Pour AMELIORER son AIM en 2023 (Valorant)',
            'description' => 'LE Guide ULTIME Pour AVOIR un AIM PARFAIT en 2023 sur Valorant',
            'post_date' => '2023-03-25 00:00:00',
            'video_url' => 'video1-VALORANT.mp4',
            'poster_url' => 'poster1-VALORANT.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'Comment s\'entrainer pour devenir meilleur et rank up sur valorant',
            'description' => 'Comment s\'entrainer pour devenir meilleur et rank up sur valorant',
            'post_date' => '2023-01-23 00:00:00',
            'video_url' => 'video2-VALORANT.mp4',
            'poster_url' => 'poster2-VALORANT.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'Comment et pourquoi Bunny-hop sur Valorant',
            'description' => 'Salut à tous, aujourd\'hui je vous explique dans un tuto pourquoi 
             et comment bunny-hop sur Valorant !',
            'post_date' => '2022-07-07 00:00:00',
            'video_url' => 'video3-VALORANT.mp4',
            'poster_url' => 'poster3-VALORANT.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'Avoir Le MEILLEUR Skin Changer Valorant en 2023 (Tutoriel Complet)',
            'description' => 'Dans cette vidéo, je vais vous montrez comment télécharger un 
             Changer Valorant en 2023 gratuitement ! C’est le premier skin changer Valorant legit.
             Le skin changer fonctionne toujours en 2023.',
            'post_date' => '2023-05-28 00:00:00',
            'video_url' => 'video4-VALORANT.mp4',
            'poster_url' => 'poster4-VALORANT.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'Vous DEVEZ Modifier ces Paramètres sur Valorant 2023! (Meilleurs Paramètres Valorant)',
            'description' => 'Dans cette vidéo, je vais vous montrez les meilleurs paramètres de 
             Valorant en 2023 que j\'utilise pour m\'aider à rank up. Vous DEVEZ modifier ces paramètres
             si vous souhaitez améliorer votre niveaux sur Valorant et mieux viser pour rank up rapidement.',
            'post_date' => '2023-05-24 00:00:00',
            'video_url' => 'video5-VALORANT.mp4',
            'poster_url' => 'poster5-VALORANT.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'TUTO | GAGNER DES FPS SUR VALORANT',
            'description' => 'Petit tuto sur Valorant, pour gagner en FPS et donc améliorer son niveau de jeu !',
            'post_date' => '2022-07-22 00:00:00',
            'video_url' => 'video6-VALORANT.mp4',
            'poster_url' => 'poster6-VALORANT.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'EXPERT CHALOEIL EN 3 MINUTES - TUTORIEL DOFUS',
            'description' => 'Je vous montre dans cette vidéo comment boucler le chaloeil en 3 minutes !',
            'post_date' => '2021-08-10 00:00:00',
            'video_url' => 'video1-DOFUS.mp4',
            'poster_url' => 'poster1-DOFUS.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'Comment apprendre à passer un donjon facilement ? Tuto Solotage Dofus',
            'description' => 'Hello ! nouvelle vidéo concernant les Solotages et l\'apprentissage des 
             donjons sur Dofus !',
            'post_date' => '2023-02-13 00:00:00',
            'video_url' => 'video2-DOFUS.mp4',
            'poster_url' => 'poster2-DOFUS.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'DOFUS - GUIDE ULTIME CHASSEUR - EPISODE 0',
            'description' => 'Bonjour à tous bienvenue dans cette nouvelle série où je vous montre
             comment up le métier de chasseur dans Dofus! Je vais vous expliquer chaque tranche de zones, 
             où drop et comment rentabiliser le metier !',
            'post_date' => '2022-04-14 00:00:00',
            'video_url' => 'video3-DOFUS.mp4',
            'poster_url' => 'poster3-DOFUS.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'Fortnite Champion Series 2023 | Major 2 | Grand Finals | N. America | Day 1',
            'description' => 'The Fortnite Champion Series is an open tournament in which the best players
             each season rise to the top and claim the title of champion in their region. Any Duo who makes
             it to the Elite Division in their region can participate!',
            'post_date' => '2023-05-14 00:00:00',
            'video_url' => 'video3-DOFUS.mp4',
            'poster_url' => 'poster1-FORTNITE.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'Les débuts des Gentle Mates sur Fortnite (FNCS Qualifier Day 1)',
            'description' => 'Les pitchouns de Fortnite ont joué les FNCS pour la première fois sous nos couleurs
             @Gotaga  et @nikof9274 étaient au cast pour vous faire vivre la compétition!
             Ils doivent terminer dans le top 200 au terme de la soirée pour espérer se qualifier 
             pour les demis finales.',
            'post_date' => '2023-04-21 00:00:00',
            'video_url' => 'video3-DOFUS.mp4',
            'poster_url' => 'poster2-FORTNITE.jpg',
            'is_header' => true,
        ],

        [
            'title' => 'I Reached Fortnite’s #1 Rank In 24 Hours! (Unreal)',
            'description' => 'Today, I challenged myself again in the most intense Fortnite competition ever!
             the FIRST Unreal Rank in Fortnite which is the #1 rank in Fortnite because of the NEW Ranked Mode! 
             The new ranked mode features so many different ranks that you have to climb in order to hit Unreal rank. ',
            'post_date' => '2023-05-20 00:00:00',
            'video_url' => 'video3-DOFUS.mp4',
            'poster_url' => 'poster3-FORTNITE.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'Being a TOP 0.1% Horizon Main (Apex Legends)',
            'description' => 'JTolerance (me) showing what being a top 0.1% apex predator horizon main in apex 
             legends season 17 looks like. Best Controller Settings in season 17(Apex Legends Arsenal)',
            'post_date' => '2023-06-18 00:00:00',
            'video_url' => 'video3-DOFUS.mp4',
            'poster_url' => 'poster1-APEX.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'Fuse, but I Drop 6,000 Damage',
            'description' => 'Dropping 6,000 Damage while using Fuse...Dropping 6,000 Damage while using Fuse...
             Dropping 6,000 Damage while using Fuse...Dropping 6,000 Damage while using Fuse...',
            'post_date' => '2023-05-25 00:00:00',
            'video_url' => 'video3-DOFUS.mp4',
            'poster_url' => 'poster2-APEX.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'Journey Trailer | Wrath of the Lich King Classic | World of Warcraft',
            'description' => 'See Northrend through the eyes of community content creator Hurricane in 
             the official Wrath of the Lich King Classic™ Journey Trailer.',
            'post_date' => '2022-09-22 00:00:00',
            'video_url' => 'video3-DOFUS.mp4',
            'poster_url' => 'poster1-WOW.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'Journey Trailer | Wrath of the Lich King Classic | World of Warcraft',
            'description' => 'Dans cette vidéo, je pars à la découverte de l extension DragonFlight sur le jeu
             World of Waracraft ! ',
            'post_date' => '2022-11-29 00:00:00',
            'video_url' => 'video3-DOFUS.mp4',
            'poster_url' => 'poster2-WOW.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'BLAST.tv Major GRAND FINAL - Vitality vs GamerLegion',
            'description' => 'We are crowning the WINNER of the BLAST.tv Paris Major, 
             the very last Major winners of CS:GO. Watch all the action in 4K and ad free on BLAST.tv!',
            'post_date' => '2023-05-21 00:00:00',
            'video_url' => 'video3-DOFUS.mp4',
            'poster_url' => 'poster1-CS.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'Nous avons gagné le dernier Major de CS:GO à Paris | Team Vitality vlog',
            'description' => 'Nous sommes entrés dans l\'histoire de Vitality et de CS:GO en remportant le dernier
             Major CS:GO devant nos fans et nos familles à Paris. Revivez le parcours légendaire de dupreeh, Magisk,
             ZywOo, Spinx et apEX depuis leur arrivée à Paris jusqu\'au trophée dans l\'Accor Arena dans ce vlog pré
             senté par Evnia',
            'post_date' => '2023-05-22 00:00:00',
            'video_url' => 'video3-DOFUS.mp4',
            'poster_url' => 'poster2-CS.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'BLAST Paris MAJOR 2023 - CS:GO Fragmovie (BEST PLAYS)',
            'description' => 'The best csgo plays from the major legends & champions stage
             FREE 2$ for the first 100 people, prmo code "virre2" at the deposit page. 
             Also use my referal code "VIRRE" for 5% deposit bonus',
            'post_date' => '2023-05-22 00:00:00',
            'video_url' => 'video3-DOFUS.mp4',
            'poster_url' => 'poster3-CS.jpg',
            'is_header' => false,
        ],

        [
            'title' => 'video de juillet',
            'description' => 'description de video de juillet',
            'post_date' => '2023-07-14 00:00:00',
            'video_url' => 'video3-DOFUS.mp4',
            'poster_url' => 'poster2-CS.jpg',
            'is_header' => false,
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $persistedVideos = [];
        $videoCount = 0;

        foreach (self::VIDEOS as $clip) {
            $video = new Video();
            $postDate = new DateTimeImmutable($clip['post_date']);
            $video
                ->setTitle($clip['title'])
                ->setDescription($clip['description'])
                ->setPostDate($postDate)
                ->setVideoUrl($clip['video_url'])
                ->setPosterUrl($clip['poster_url'])
                ->setIsHeader($clip['is_header']);
            $manager->persist($video);
            $this->addReference('video_' . $videoCount, $video);
            $videoCount++;
            $persistedVideos[] = $video;
        }


        foreach ($persistedVideos as $persistedVideo) {
            for ($i = 0; $i < 3; $i++) {
                $persistedVideo
                    ->addTag($this->getReference('tag_' . TagFixtures::TAGS[rand(0, count(TagFixtures::TAGS) - 1)]));
            }
            $manager->persist($video);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [TagFixtures::class];
    }
}
