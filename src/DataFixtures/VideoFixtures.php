<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use App\Entity\Video as VideoEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Media\Video;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class VideoFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public const VIDEOS = [
        [
            'title' => 'Guide Maokai en 3 Minutes - Un guide pour League of Legends',
            'description' => 'Vous avez 3 minutes de libre ? Pourquoi ne pas jeter un coup
            d\'œil rapide sur comment jouer Maokai Jungle !
             En tant qu\'arbre, la jungle est absolument l\'endroit où Maokai excelle !
             Malgré le fait qu\'il soit redoutable en tant que support
             et sur la toplane, ses récents buffs en termes de vitesse de clear lui permettent
             de dévaster la jungle et d\'avoir un impact massif
             avec ses ganks et ses combats en équipe !',
            'post_date' => '2023-06-04 00:00:00',
            'video_url' => 'video1-LOL.mp4',
            'poster_url' => 'poster1-LOL.jpg',
            'is_header' => false,
            'tag' => ['tag_LOL', 'tag_MULTIPLAYER', 'tag_MOBA'],
        ],

        [
            'title' => 'Guide Lux en 3 Minutes - Un guide pour League of Legends',
            'description' => 'Vous avez 3 minutes de libre ? Pourquoi ne pas jeter un coup
            d\'œil rapide sur comment jouer Lux en Mid Lane ?
             Lux est un champion facile à apprendre mais complexe à maîtriser, qui excelle dans
             le contrôle de la carte avec ses capacités,
             infligeant des dégâts à distance tout en poussant sa lane avant de combo complet
             un champion pour l\'envoyer au cimetière !
             Elle est menaçante en tant que support, mais avec l\'or que la midlane octroie,
             elle peut être une véritable force !',
            'post_date' => '2023-05-31 00:00:00',
            'video_url' => 'video2-LOL.mp4',
            'poster_url' => 'poster2-LOL.jpg',
            'is_header' => false,
            'tag' => ['tag_LOL', 'tag_MULTIPLAYER', 'tag_MOBA'],
        ],

        [
            'title' => 'Guide Katarina en 3 Minutes - Un guide pour League of Legends',
            'description' => 'Vous avez 3 minutes de libre ? Pourquoi ne pas jeter un coup
            d\'œil rapide sur comment jouer Katarina en Mid Lane !
             Katarina est l\'assassin ultime qui saute sur les champions, tourbillonne et
             les élimine de manière spectaculaire. Elle est la vraie
             définition d\'un assassin de combat d\'équipe !',
            'post_date' => '2023-02-01 00:00:00',
            'video_url' => 'video3-LOL.mp4',
            'poster_url' => 'poster3-LOL.jpg',
            'is_header' => false,
            'tag' => ['tag_LOL', 'tag_MULTIPLAYER', 'tag_MOBA'],
        ],

        [
            'title' => 'Guide Samira en 3 Minutes - Un guide pour League of Legends',
            'description' => 'Vous avez 3 minutes de libre ? Pourquoi ne pas jeter un coup
            d\'œil rapide sur comment jouer Samira en Bot Lane !
             Samira est un carry vraiment unique qui compte sur des dégâts bruts plutôt que
             d\'attaquer de nombreuses fois - son système de combo
             lui permet de gagner énormément de vitesse de déplacement avant d\'éliminer
             toute l\'équipe ennemie !',
            'post_date' => '2022-12-19 00:00:00',
            'video_url' => 'video4-LOL.mp4',
            'poster_url' => 'poster4-LOL.jpg',
            'is_header' => false,
            'tag' => ['tag_LOL', 'tag_MULTIPLAYER', 'tag_MOBA'],
        ],

        [
            'title' => 'Guide Illaoi en 3 Minutes - Un guide pour League of Legends',
            'description' => 'Vous avez 3 minutes de libre ? Pourquoi ne pas jeter un
            coup d\'œil rapide sur comment jouer Illaoi en Top Lane !
             Illaoi est une bête en toplane, une énorme bruiser qui aime toutes les situations de
             1v5 dans lesquelles elle peut se retrouver !',
            'post_date' => '2022-09-18 00:00:00',
            'video_url' => 'video5-LOL.mp4',
            'poster_url' => 'poster5-LOL.jpg',
            'is_header' => false,
            'tag' => ['tag_LOL', 'tag_MULTIPLAYER', 'tag_MOBA'],
        ],

        [
            'title' => 'Guide Heimerdinger en 3 Minutes - Un guide pour League of Legends',
            'description' => 'Vous avez 3 minutes de libre ? Pourquoi ne pas jeter un coup
            d\'œil rapide sur comment jouer Heimerdinger en Support !
             Heimerdinger s\'est récemment imposé en tant que choix de support unique, offrant une
             puissance de push, des étourdissements
             et des dégâts explosifs massifs !',
            'post_date' => '2023-05-12 00:00:00',
            'video_url' => 'video6-LOL.mp4',
            'poster_url' => 'poster6-LOL.jpg',
            'is_header' => false,
            'tag' => ['tag_LOL', 'tag_MULTIPLAYER', 'tag_MOBA'],
        ],

        [
            'title' => 'Le Guide ULTIME Pour Améliorer son AIM en 2023 (Valorant)',
            'description' => 'Le Guide ULTIME Pour AVOIR un AIM PARFAIT en 2023 sur Valorant',
            'post_date' => '2023-03-25 00:00:00',
            'video_url' => 'video1-VALORANT.mp4',
            'poster_url' => 'poster1-VALORANT.jpg',
            'is_header' => false,
            'tag' => ['tag_VALORANT', 'tag_MULTIPLAYER', 'tag_FPS'],
        ],

        [
            'title' => 'Comment s\'entraîner pour devenir meilleur et monter en rang sur Valorant',
            'description' => 'Comment s\'entraîner pour devenir meilleur et monter en rang sur Valorant',
            'post_date' => '2023-01-23 00:00:00',
            'video_url' => 'video2-VALORANT.mp4',
            'poster_url' => 'poster2-VALORANT.jpg',
            'is_header' => false,
            'tag' => ['tag_VALORANT', 'tag_MULTIPLAYER', 'tag_FPS'],
        ],

        [
            'title' => 'Comment et pourquoi faire du Bunny-hop sur Valorant',
            'description' => 'Salut à tous, aujourd\'hui je vous explique dans un tuto pourquoi et
            comment faire du bunny-hop sur Valorant !',
            'post_date' => '2022-07-07 00:00:00',
            'video_url' => 'video3-VALORANT.mp4',
            'poster_url' => 'poster3-VALORANT.jpg',
            'is_header' => false,
            'tag' => ['tag_VALORANT', 'tag_MULTIPLAYER', 'tag_FPS'],
        ],

        [
            'title' => 'Avoir Le MEILLEUR Skin Changer Valorant en 2023 (Tutoriel Complet)',
            'description' => 'Dans cette vidéo, je vais vous montrer comment télécharger un Changer
            Valorant en 2023 gratuitement !
             C’est le premier skin changer Valorant légitime. Le skin changer fonctionne toujours en 2023.',
            'post_date' => '2023-05-28 00:00:00',
            'video_url' => 'video4-VALORANT.mp4',
            'poster_url' => 'poster4-VALORANT.jpg',
            'is_header' => false,
            'tag' => ['tag_VALORANT', 'tag_MULTIPLAYER', 'tag_FPS'],
        ],

        [
            'title' => 'Vous DEVEZ Modifier ces Paramètres sur Valorant 2023! (Meilleurs
            Paramètres Valorant)',
            'description' => 'Dans cette vidéo, je vais vous montrer les meilleurs paramètres de
            Valorant en 2023 que j\'utilise pour m\'aider à rank up.
            Vous DEVEZ modifier ces paramètres si vous souhaitez améliorer votre niveau sur Valorant
            et mieux viser pour monter rapidement en rang.',
            'post_date' => '2023-05-24 00:00:00',
            'video_url' => 'video5-VALORANT.mp4',
            'poster_url' => 'poster5-VALORANT.jpg',
            'is_header' => false,
            'tag' => ['tag_VALORANT', 'tag_MULTIPLAYER', 'tag_FPS'],
        ],

        [
            'title' => 'TUTO | GAGNER DES FPS SUR VALORANT',
            'description' => 'Petit tuto sur Valorant, pour gagner en FPS et donc améliorer son niveau
            de jeu !',
            'post_date' => '2022-07-22 00:00:00',
            'video_url' => 'video6-VALORANT.mp4',
            'poster_url' => 'poster6-VALORANT.jpg',
            'is_header' => false,
            'tag' => ['tag_VALORANT', 'tag_MULTIPLAYER', 'tag_FPS'],
        ],

        [
            'title' => 'EXPERT CHALOEIL EN 3 MINUTES - TUTORIEL DOFUS',
            'description' => 'Je vous montre dans cette vidéo comment boucler le chaloeil en 3 minutes !',
            'post_date' => '2021-08-10 00:00:00',
            'video_url' => 'video1-DOFUS.mp4',
            'poster_url' => 'poster1-DOFUS.jpg',
            'is_header' => false,
            'tag' => ['tag_DOFUS', 'tag_MULTIPLAYER', 'tag_MMORPG', 'tag_SOLO'],
        ],

        [
            'title' => 'Comment apprendre à passer un donjon facilement ? Tuto Solotage Dofus',
            'description' => 'Bonjour ! nouvelle vidéo concernant les Solotages et l\'apprentissage
            des donjons sur Dofus !',
            'post_date' => '2023-02-13 00:00:00',
            'video_url' => 'video2-DOFUS.mp4',
            'poster_url' => 'poster2-DOFUS.jpg',
            'is_header' => false,
            'tag' => ['tag_DOFUS', 'tag_MULTIPLAYER', 'tag_MMORPG', 'tag_SOLO'],
        ],

        [
            'title' => 'DOFUS - GUIDE ULTIME CHASSEUR - ÉPISODE 0',
            'description' => 'Bonjour à tous, bienvenue dans cette nouvelle série où je vous montre
            comment monter le métier de chasseur dans Dofus !
             Je vais vous expliquer chaque tranche de zones, où dropper et comment rentabiliser le
             métier !',
            'post_date' => '2022-04-14 00:00:00',
            'video_url' => 'video3-DOFUS.mp4',
            'poster_url' => 'poster3-DOFUS.jpg',
            'is_header' => false,
            'tag' => ['tag_DOFUS', 'tag_MULTIPLAYER', 'tag_MMORPG', 'tag_SOLO'],
        ],

        [
            'title' => 'Fortnite Champion Series 2023 | Major 2 | Grand Finals | N. America | Day 1',
            'description' => 'Le Fortnite Champion Series est un tournoi ouvert dans lequel les
             meilleurs joueurs de chaque saison se hissent
             au sommet et revendiquent le titre de champion de leur région. Toute équipe qui atteint
             la division Élite dans sa région peut participer !',
            'post_date' => '2023-05-14 00:00:00',
            'video_url' => 'video1-FORTNITE.mp4',
            'poster_url' => 'poster1-FORTNITE.jpg',
            'is_header' => false,
            'tag' => ['tag_FORTNITE', 'tag_MULTIPLAYER', 'tag_FPS'],
        ],

        [
            'title' => 'Les débuts des Gentle Mates sur Fortnite (FNCS Qualifier Day 1)',
            'description' => 'Les pitchouns de Fortnite ont joué les FNCS pour la première
            fois sous nos couleurs
             @Gotaga et @nikof9274 étaient au cast pour vous faire vivre la compétition !
             Ils doivent terminer dans le top 200 au terme de la soirée pour espérer se qualifier
             pour les demis finales.',
            'post_date' => '2023-04-21 00:00:00',
            'video_url' => 'video2-FORTNITE.mp4',
            'poster_url' => 'poster2-FORTNITE.jpg',
            'is_header' => false,
            'tag' => ['tag_FORTNITE', 'tag_MULTIPLAYER', 'tag_FPS'],
        ],

        [
            'title' => 'J\'ai atteint le rang #1 de Fortnite en 24 heures ! (Incroyable)',
            'description' => 'Aujourd\'hui, je me suis lancé dans la compétition la plus
            intense de Fortnite !
             Le premier rang Unreal dans Fortnite est le rang #1 car il s\'agit du nouveau
             mode classé !
             Le nouveau mode classé comporte de nombreux rangs différents que vous devez
             gravir pour atteindre le rang Unreal.',
            'post_date' => '2023-05-20 00:00:00',
            'video_url' => 'video3-FORTNITE.mp4',
            'poster_url' => 'poster3-FORTNITE.jpg',
            'is_header' => false,
            'tag' => ['tag_FORTNITE', 'tag_MULTIPLAYER', 'tag_FPS'],
        ],

        [
            'title' => 'Être l\'un des 0,1% de joueurs les meilleurs sur Horizon (Apex Legends)',
            'description' => 'JTolerance (moi) montre à quoi ressemble d\'être l\'un des 0,1%
             des joueurs les meilleurs en tant que main d\'apex predator Horizon dans Apex Legends saison 17.
             Les meilleures configurations de manettes en saison 17 (Arsenal Apex Legends)',
            'post_date' => '2023-06-18 00:00:00',
            'video_url' => 'video1-APEX.mp4',
            'poster_url' => 'poster1-APEX.jpg',
            'is_header' => true,
            'tag' => ['tag_APEX', 'tag_MULTIPLAYER', 'tag_FPS'],
        ],

        [
            'title' => 'Fuse, mais je fais 6000 de dégâts',
            'description' => 'Je fais 6000 de dégâts tout en utilisant Fuse... Je fais 6000
            de dégâts tout en utilisant Fuse...
             Je fais 6000 de dégâts tout en utilisant Fuse... Je fais 6000 de dégâts tout
             en utilisant Fuse...',
            'post_date' => '2023-05-25 00:00:00',
            'video_url' => 'video2-APEX.mp4',
            'poster_url' => 'poster2-APEX.jpg',
            'is_header' => false,
            'tag' => ['tag_APEX', 'tag_MULTIPLAYER', 'tag_FPS'],
        ],

        [
            'title' => 'Appel des Croisades - Bande-annonce des champions | Wrath of
            the Lich King Classic | World of Warcraft',
            'description' => 'À la suite de la destruction du Roi-Liche, les héros d\'Azeroth
            se rassemblent pour prouver leur valeur pour la bataille finale à venir.',
            'post_date' => '2023-06-15 00:00:00',
            'video_url' => 'video1-WOW.mp4',
            'poster_url' => 'poster1-WOW.jpg',
            'is_header' => false,
            'tag' => ['tag_WOW', 'tag_MULTIPLAYER', 'tag_MMORPG', 'tag_SOLO'],
        ],

        [
            'title' => 'Bande-annonce du voyage | Wrath of the Lich King Classic |
            World of Warcraft',
            'description' => 'Découvrez le Norfendre à travers les yeux du créateur de
            contenu de la communauté Hurricane dans la bande-annonce officielle du Voyage
            de Wrath of the Lich King Classic™.',
            'post_date' => '2022-11-29 00:00:00',
            'video_url' => 'video2-WOW.mp4',
            'poster_url' => 'poster2-WOW.jpg',
            'is_header' => false,
            'tag' => ['tag_WOW', 'tag_MULTIPLAYER', 'tag_MMORPG', 'tag_SOLO'],
        ],

        [
            'title' => 'GRANDE FINALE DU MAJOR BLAST.tv - Vitality contre GamerLegion',
            'description' => 'Nous couronnons le VAINQUEUR du Major BLAST.tv à Paris,
            les tout derniers vainqueurs majeurs de CS:GO.
             Regardez toute l\'action en 4K et sans publicité sur BLAST.tv !',
            'post_date' => '2023-05-21 00:00:00',
            'video_url' => 'video1-CS.mp4',
            'poster_url' => 'poster1-CS.jpg',
            'is_header' => false,
            'tag' => ['tag_CS', 'tag_MULTIPLAYER', 'tag_FPS'],
        ],

        [
            'title' => 'Nous avons gagné le dernier Major de CS:GO à Paris | Vlog Team Vitality',
            'description' => 'Nous avons écrit l\'histoire de Vitality et de CS:GO en
            remportant le dernier Major CS:GO devant nos fans et nos familles à Paris.
             Revivez le parcours légendaire de dupreeh, Magisk, ZywOo, Spinx et apEX depuis
             leur arrivée à Paris jusqu\'au trophée dans l\'Accor Arena dans ce vlog présenté par Evnia.',
            'post_date' => '2023-05-22 00:00:00',
            'video_url' => 'video2-CS.mp4',
            'poster_url' => 'poster2-CS.jpg',
            'is_header' => false,
            'tag' => ['tag_CS', 'tag_MULTIPLAYER', 'tag_FPS'],
        ],

        [
            'title' => 'BLAST Paris MAJOR 2023 - Fragmovie CS:GO (MEILLEURS PLAYS)',
            'description' => 'Les meilleures actions de CS:GO de la phase des légendes
             et des champions du Major,
             2 $ offerts aux 100 premières personnes, code promo "virre2" à la page de dépôt.
             Utilisez également mon code de parrainage "VIRRE" pour un bonus de dépôt de 5 %.',
            'post_date' => '2023-05-22 00:00:00',
            'video_url' => 'video3-CS.mp4',
            'poster_url' => 'poster3-CS.jpg',
            'is_header' => false,
            'tag' => ['tag_CS', 'tag_MULTIPLAYER', 'tag_FPS'],
        ],

        [
            'title' => 'Le Suprême Ventoso | Smite - Rant sur Susano',
            'description' => 'Comme toujours, ceci est destiné à être satirique et ne
            reflète en aucun cas les performances actuelles du Dieu,
             j\'espère que vous avez quand même apprécié, abonnez-vous pour plus de rants,
             top 5, guides et plus sur la chaîne deux fois par semaine !',
            'post_date' => '2018-07-10 00:00:00',
            'video_url' => 'video1-SMITE.mp4',
            'poster_url' => 'poster1-SMITE.jpg',
            'is_header' => false,
            'tag' => ['tag_SMITE', 'tag_MULTIPLAYER', 'tag_MOBA'],
        ],

        [
            'title' => 'Cet objet peut tuer le Géant de la Faille - Smite -
            Ratatoskr Guide Solo',
            'description' => 'Ratatoskr est un superbe champion et il peut accomplir de
            nombreuses choses différentes.
             L\'objectif de ce guide est de vous montrer comment jouez Ratatoskr comme un
             tank solo et ce que vous devez faire pour réussir en tant que tel.',
            'post_date' => '2021-12-09 00:00:00',
            'video_url' => 'video2-SMITE.mp4',
            'poster_url' => 'poster2-SMITE.jpg',
            'is_header' => false,
            'tag' => ['tag_SMITE', 'tag_MULTIPLAYER', 'tag_MOBA'],
        ],

    ];


    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $videoCount = 0;

        foreach (self::VIDEOS as $clip) {
            $video = new VideoEntity();
            $postDate = new DateTimeImmutable($clip['post_date']);
            $video
                ->setTitle($clip['title'])
                ->setDescription($clip['description'])
                ->setPostDate($postDate)
                ->setVideoUrl($clip['video_url'])
                ->setPosterUrl($clip['poster_url'])
                ->setIsHeader($clip['is_header'])
                ->setIsPremium((bool)rand(0, 1));
            $this->addReference('video_' . $videoCount, $video);
            $videoCount++;
            foreach ($clip['tag'] as $tag) {
                $video
                    ->addTag($this->getReference($tag));
            }
            $manager->persist($video);

            // $ffmpeg = FFMpeg::create();
            // /** @var Video $videoGif */
            // $videoGif = $ffmpeg->open($this->params->get('video_directory') . '/' . $clip['video_url']);
            // $fileNameGif = pathinfo($clip['poster_url'], PATHINFO_FILENAME);
            // $fileNameGif = $fileNameGif . '.gif';

            // $videoGif
            //     ->gif(TimeCode::fromSeconds(20), new Dimension(280, 240), 4)
            //     ->save($this->params->get('image_directory') . '/' . $fileNameGif);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [TagFixtures::class];
    }
}
