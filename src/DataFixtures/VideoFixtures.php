<?php

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VideoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $video = new Video();
        $video->setTitle('3 Minute Maokai Guide - A guide for League of Legends');
        $video->setDescription('Got 3 minutes spare? Why not take a quick look at how to play Maokai Jungle! As a tree the jungle is absolutely where Maokai belongs! Despite him being a beast at both supporting and top laning his recent buffs to his clear speed allows him to tear through the jungle and provide massive impact with his ganks and teamfights!');
        $date = new \DateTime('2023-06-04');
        $video->setPostDate($date);
        $video->setVideoUrl('video1-LOL.mp4');
        $video->setPosterUrl('poster1-LOL.jpg');
        $manager->persist($video);

        $video = new Video();
        $video->setTitle('3 Minute Lux Guide - A guide for League of Legends');
        $video->setDescription('Got 3 minutes spare? Why not take a quick look at how to play Lux Mid Lane? Lux is an easy to learn by complex to master champion who excels in controlling the map with her abilities, poking away while pushing her lane before full comboing a champion back to a grey screen! She\'s a threat as a support, but with the gold that mid grants she can be an absolute force!');
        $date = new \DateTime('2023-05-31');
        $video->setPostDate($date);
        $video->setVideoUrl('video2-LOL.mp4');
        $video->setPosterUrl('poster2-LOL.jpg');
        $manager->persist($video);

        $video = new Video();
        $video->setTitle('3 Minute Katarina Guide - A guide for League of Legends');
        $video->setDescription('Got 3 minutes spare? Why not take a quick look at how to play Katarina Mid Lane! Katarina is the original blender champion - The way she jumps on champions, spins and bursts them out is the true definition of a team fighting assassin!');
        $date = new \DateTime('2023-02-01');
        $video->setPostDate($date);
        $video->setVideoUrl('video3-LOL.mp4');
        $video->setPosterUrl('poster3-LOL.jpg');
        $manager->persist($video);

        $video = new Video();
        $video->setTitle('3 Minute Samira Guide - A guide for League of Legends');
        $video->setDescription('Got 3 minutes spare? Why not take a quick look at how to play Samira Bot Lane! Samira is a truly unique carry where she relying on raw damage rather than attacking many times - her combo system lets her build up a ton of movement speed before penta-killing the enemy team!');
        $date = new \DateTime('2022-12-19');
        $video->setPostDate($date);
        $video->setVideoUrl('video4-LOL.mp4');
        $video->setPosterUrl('poster4-LOL.jpg');
        $manager->persist($video);

        $video = new Video();
        $video->setTitle('3 Minute Illaoi Guide - A guide for League of Legends');
        $video->setDescription('Got 3 minutes spare? Why not take a quick look at how to play Illaoi Top! Illaoi is a beast in the top lane coming in as a huge bruiser who loves every 1v5 situation she can find herself in!');
        $date = new \DateTime('2022-09-18');
        $video->setPostDate($date);
        $video->setVideoUrl('video5-LOL.mp4');
        $video->setPosterUrl('poster5-LOL.jpg');
        $manager->persist($video);

        $video = new Video();
        $video->setTitle('3 Minute Heimerdinger Guide - A guide for League of Legends');
        $video->setDescription('Got 3 minutes spare? Why not take a quick look at how to play Heimerdinger Support! Heimerdinger has recently found himself as a unique support pick offering a ton of pushing power, stuns and massaive burst damage!');
        $date = new \DateTime('2023-05-12');
        $video->setPostDate($date);
        $video->setVideoUrl('video6-LOL.mp4');
        $video->setPosterUrl('poster6-LOL.jpg');
        $manager->persist($video);

        $video = new Video();
        $video->setTitle('LE Guide *ULTIME* Pour AMELIORER son AIM en 2023 (Valorant)');
        $video->setDescription('LE Guide ULTIME Pour AVOIR un AIM PARFAIT en 2023 sur Valorant');
        $date = new \DateTime('2023-03-25');
        $video->setPostDate($date);
        $video->setVideoUrl('video1-VALORANT.mp4');
        $video->setPosterUrl('poster1-VALORANT.jpg');
        $manager->persist($video);

        $video = new Video();
        $video->setTitle('Comment s\'entrainer pour devenir meilleur et rank up sur valorant');
        $video->setDescription('Comment s\'entrainer pour devenir meilleur et rank up sur valorant');
        $date = new \DateTime('2023-01-23');
        $video->setPostDate($date);
        $video->setVideoUrl('video2-VALORANT.mp4');
        $video->setPosterUrl('poster2-VALORANT.jpg');
        $manager->persist($video);

        $video = new Video();
        $video->setTitle('Comment et pourquoi Bunny-hop sur Valorant');
        $video->setDescription('Salut à tous, aujourd\'hui je vous explique dans un tuto pourquoi et comment bunny-hop sur Valorant !');
        $date = new \DateTime('2022-07-07');
        $video->setPostDate($date);
        $video->setVideoUrl('video3-VALORANT.mp4');
        $video->setPosterUrl('poster3-VALORANT.jpg');
        $manager->persist($video);

        $video = new Video();
        $video->setTitle('Avoir Le MEILLEUR Skin Changer Valorant en 2023 (Tutoriel Complet)');
        $video->setDescription('Dans cette vidéo, je vais vous montrez comment télécharger un Skin Changer Valorant en 2023 gratuitement ! C’est le premier skin changer Valorant legit. Le skin changer fonctionne toujours en 2023.');
        $date = new \DateTime('2023-05-28');
        $video->setPostDate($date);
        $video->setVideoUrl('video4-VALORANT.mp4');
        $video->setPosterUrl('poster4-VALORANT.jpg');
        $manager->persist($video);

        $video = new Video();
        $video->setTitle('Vous DEVEZ Modifier ces Paramètres sur Valorant 2023! (Meilleurs Paramètres Valorant)');
        $video->setDescription('Dans cette vidéo, je vais vous montrez les meilleurs paramètres de Valorant en 2023 que j\'utilise pour m\'aider à rank up. Vous DEVEZ modifier ces paramètres si vous souhaitez améliorer votre niveaux sur Valorant et mieux viser pour rank up rapidement.');
        $date = new \DateTime('2023-05-24');
        $video->setPostDate($date);
        $video->setVideoUrl('video5-VALORANT.mp4');
        $video->setPosterUrl('poster5-VALORANT.jpg');
        $manager->persist($video);

        $video = new Video();
        $video->setTitle('TUTO | GAGNER DES FPS SUR VALORANT');
        $video->setDescription('Petit tuto sur Valorant, pour gagner en FPS et donc améliorer son niveau de jeu !');
        $date = new \DateTime('2022-07-22');
        $video->setPostDate($date);
        $video->setVideoUrl('video6-VALORANT.mp4');
        $video->setPosterUrl('poster6-VALORANT.jpg');
        $manager->persist($video);

        $video = new Video();
        $video->setTitle('EXPERT CHALOEIL EN 3 MINUTES - TUTORIEL DOFUS');
        $video->setDescription('Je vous montre dans cette vidéo comment boucler le chaloeil en 3 minutes !');
        $date = new \DateTime('2021-08-10');
        $video->setPostDate($date);
        $video->setVideoUrl('video1-DOFUS.mp4');
        $video->setPosterUrl('poster1-DOFUS.jpg');
        $manager->persist($video);

        $video = new Video();
        $video->setTitle('Comment apprendre à passer un donjon facilement ? Tuto Solotage Dofus');
        $video->setDescription('Hello ! nouvelle vidéo concernant les Solotages et l\'apprentissage des donjons sur Dofus !');
        $date = new \DateTime('2023-02-13');
        $video->setPostDate($date);
        $video->setVideoUrl('video2-DOFUS.mp4');
        $video->setPosterUrl('poster2-DOFUS.jpg');
        $manager->persist($video);

        $video = new Video();
        $video->setTitle('DOFUS - GUIDE ULTIME CHASSEUR - EPISODE 0');
        $video->setDescription('Bonjour à tous bienvenue dans cette nouvelle série où je vous montre comment up le métier de chasseur dans Dofus! Je vais vous expliquer chaque tranche de zones, où drop et comment rentabiliser le metier !');
        $date = new \DateTime('2022-04-14');
        $video->setPostDate($date);
        $video->setVideoUrl('video3-DOFUS.mp4');
        $video->setPosterUrl('poster3-DOFUS.jpg');
        $manager->persist($video);

        $manager->flush();
    }
}
