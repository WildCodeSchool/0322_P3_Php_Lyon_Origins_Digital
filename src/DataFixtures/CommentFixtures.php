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
    public const COMMENTS = [
       "\"Super vidéo ! J'ai adoré le gameplay.\"",
       "\"Les compétences des joueurs sont incroyables.\"",
       "\"Le match était très intense.\"",
       "\"Je suis fan de cette équipe. Vraiment impressionnant.\"",
       "\"Les commentateurs ont fait un excellent travail.\"",
       "\"C'est la meilleure vidéo d'e-sport que j'ai vue jusqu'à présent.\"",
       "\"Je suis impressionné par la stratégie utilisée.\"",
       "\"Les graphismes du jeu sont époustouflants.\"",
       "\"J'ai apprécié chaque seconde de cette vidéo.\"",
       "\"Je recommande vivement cette vidéo à tous les fans d'e-sport.\"",
       "\"Ce tournoi est incroyable !\"",
       "\"Les joueurs ont une précision impressionnante.\"",
       "\"J'aimerais pouvoir jouer comme eux.\"",
       "\"Les rebondissements dans ce match étaient palpitants.\"",
       "\"Je suis accro à cette vidéo.\"",
       "\"Les équipes sont très compétitives.\"",
       "\"Les tactiques utilisées sont innovantes.\"",
       "\"Ce jeu est vraiment addictif.\"",
       "\"Les graphismes sont à couper le souffle.\"",
       "\"Les ralentis mettent en valeur les moments forts.\"",
       "\"C'est génial de voir des joueurs professionnels en action.\"",
       "\"Je suis émerveillé par les compétences de ces joueurs.\"",
       "\"J'ai regardé cette vidéo plusieurs fois déjà.\"",
       "\"Les commentaires ajoutent vraiment à l'expérience de visionnage.\"",
       "\"Ce match a été très serré jusqu'à la fin.\"",
       "\"Les joueurs sont incroyablement talentueux.\"",
       "\"La communauté e-sport est fantastique.\"",
       "\"Je suis fan de ce jeu depuis des années.\"",
       "\"Ces compétitions sont toujours passionnantes.\"",
       "\"Je rêve de pouvoir participer à un tel tournoi.\"",
       "\"Les moments de suspense sont à couper le souffle.\"",
       "\"Je suis époustouflé par les compétences de ces joueurs.\"",
       "\"Cette vidéo est un régal pour les fans d'e-sport.\"",
       "\"Les commentateurs rendent le visionnage encore plus intéressant.\"",
       "\"Je recommande cette vidéo à tous mes amis.\"",
       "\"Les émotions sont palpables dans ce match.\"",
       "\"Je suis admiratif du niveau de jeu.\"",
       "\"Ces joueurs sont vraiment doués.\"",
       "\"Cette vidéo me motive à m'entraîner davantage.\"",
       "\"Les stratégies mises en place sont impressionnantes.\"",
       "\"Je suis captivé du début à la fin.\"",
       "\"Ce jeu est en constante évolution.\"",
       "\"Les réactions des joueurs sont incroyables.\"",
       "\"Les équipes se sont surpassées lors de ce match.\"",
       "\"Les joueurs font preuve d'une grande précision.\"",
       "\"Cette vidéo est une source d'inspiration.\"",
       "\"Les compétitions d'e-sport sont de plus en plus populaires.\"",
       "\"Je suis accro à ce jeu.\"",
       "\"Les joueurs ont une excellente coordination.\"",
       "\"Le niveau de compétition est très élevé.\"",
       "\"Cette vidéo m'a donné envie de jouer.\"",
       "\"J'ai passé un excellent moment en regardant cette vidéo.\"",
       "\"Les stratégies utilisées sont impressionnantes.\"",
       "\"Je suis toujours émerveillé par les talents des joueurs.\"",
       "\"Ce match était vraiment intense.\"",
       "\"Les joueurs font preuve d'une grande concentration.\"",
       "\"Je suis impressionné par la rapidité d'exécution des actions.\"",
       "\"Les joueurs ont une excellente maîtrise du jeu.\"",
       "\"Les fans sont très passionnés.\"",
       "\"Je suis fier de faire partie de la communauté e-sport.\"",
       "\"Les meilleurs moments sont mis en valeur dans cette vidéo.\"",
       "\"Les compétitions d'e-sport sont un vrai spectacle.\"",
       "\"Je suis fan de cette équipe depuis longtemps.\"",
       "\"Les réactions des joueurs sont hilarantes.\"",
       "\"Les mouvements sont d'une grande fluidité.\"",
       "\"Cette vidéo a suscité mon intérêt pour ce jeu.\"",
       "\"Les joueurs ont un timing parfait.\"",
       "\"La coordination entre les membres de l'équipe est impressionnante.\"",
       "\"Les joueurs font preuve d'une grande créativité.\"",
       "\"J'ai hâte de voir les prochaines compétitions.\"",
       "\"Cette vidéo a rendu ma journée meilleure.\"",
       "\"Les joueurs sont des modèles pour moi.\"",
       "\"Ce match a été épique.\"",
       "\"Les commentaires sont informatifs et divertissants.\"",
       "\"Les compétences des joueurs sont hors du commun.\"",
       "\"Je suis impressionné par la stratégie mise en place.\"",
       "\"Les graphismes de ce jeu sont à couper le souffle.\"",
       "\"Les réactions des joueurs sont dignes d'admiration.\"",
       "\"Cette vidéo me donne envie de jouer sans arrêt.\"",
       "\"Les joueurs ont une excellente coordination d'équipe.\"",
       "\"Ce match a été plein de rebondissements.\"",
       "\"Je suis captivé par la vitesse d'exécution des actions.\"",
       "\"Les joueurs font preuve d'une grande maîtrise des mécaniques du jeu.\"",
       "\"Les commentaires apportent une perspective intéressante.\"",
       "\"Je suis impressionné par le professionnalisme des joueurs.\"",
       "\"Cette vidéo est une source d'inspiration pour moi.\"",
       "\"Les compétitions d'e-sport sont un véritable spectacle.\"",
       "\"Je suis toujours émerveillé par les talents des joueurs professionnels.\"",
       "\"Ce match était incroyablement intense.\"",
       "\"Les joueurs ont un niveau de jeu exceptionnel.\"",
       "\"Les mouvements sont d'une grande précision.\"",
       "\"Cette vidéo m'a donné envie de me mettre sérieusement à ce jeu.\"",
       "\"Les joueurs ont une coordination parfaite.\"",
       "\"La stratégie mise en place est digne des plus grands tacticiens.\"",
       "\"J'ai passé un moment fantastique en regardant cette vidéo.\"",
       "\"Les meilleurs moments sont encore plus spectaculaires en vidéo.\"",
       "\"Les compétitions d'e-sport sont une véritable passion pour moi.\"",
       "\"Je suis fan de cette équipe depuis le début.\"",
       "\"Les réactions des joueurs sont hilarantes à certains moments.\"",
       "\"Les mouvements des joueurs sont extrêmement fluides.\"",
       "\"Cette vidéo a suscité mon intérêt pour le jeu de manière significative.\"",
       "\"Les joueurs ont un timing parfait dans leurs actions.\"",
       "\"La coordination entre les membres de l'équipe est vraiment impressionnante.\"",
       "\"Les joueurs font preuve d'une grande créativité dans leur approche du jeu.\"",
       "\"J'attends avec impatience les prochaines compétitions\""];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $maxVideosValue = (count(VideoFixtures::VIDEOS)) - 1;
        $maxUsersValue = (count(UserFixtures::USERS)) - 1;

        foreach (self::COMMENTS as $uniqComment) {
            $dateTime = $faker->dateTimeBetween('-2 months', 'now');
            $dateTimeImmutable = DateTimeImmutable::createFromMutable($dateTime);

            $comment = new Comment();
            $comment
                ->setPostDate($dateTimeImmutable)
                ->setUser($this->getReference('user_' . rand(0, $maxUsersValue)))
                ->setContent($uniqComment)
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
