<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Video;
use App\Repository\TagRepository;
use App\Repository\VideoRepository;
use App\Service\ChartManager;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private TagRepository $tagRepository,
        private VideoRepository $videoRepository,
        private ChartManager $chartManager,
    ) {
        $tagRepository = $this->tagRepository;
        $chartManager = $this->chartManager;
    }

    #[Route('/admin', name: 'admin_dashboard')]
    public function index(): Response
    {
        $tags = $this->tagRepository->findAll();
        $videos = $this->videoRepository->findAll();

        $tagNames = [];
        $tagVideoCount = [];

        foreach ($tags as $tag) {
            $tagNames[] = $tag->getName();
            $tagVideoCount[] = count($tag->getVideos());
        }

        $chartVideosByTag = $this->chartManager->createBarChartBy(
            'Vidéos par tag',
            $tagNames,
            $tagVideoCount,
        );

        $videoTitles = [];
        $favCount = [];
        $viewsCount = [];

        foreach ($videos as $video) {
            $videoTitles[] = substr($video->getTitle(), 0, 10) . '...';
            $favCount[] = count($video->getUsersFavorited());
            $viewsCount[] = count($video->getVieweds());
        }

        $chartFavsByVideo = $this->chartManager->createBarChartBy(
            'Favoris par video',
            $videoTitles,
            $favCount,
        );

        $chartViewsByVideo = $this->chartManager->createBarChartBy(
            'Vues par video',
            $videoTitles,
            $viewsCount,
        );

        return $this->render('admin/dashboard.html.twig', [
            'chartVideosByTag' => $chartVideosByTag,
            'chartFavsByVideo' => $chartFavsByVideo,
            'chartViewsByVideo' => $chartViewsByVideo,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin Gaming Gurus');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa-solid fa-gear');
        yield MenuItem::linkToRoute('Retour au site', 'fa-solid fa-house', 'home_index');
        yield MenuItem::linkToCrud('Gestion de vidéos', 'fa-solid fa-play', Video::class);
        yield MenuItem::linkToRoute('Ajouter une vidéo', 'fa-solid fa-file-arrow-up', 'upload_video');
        yield MenuItem::linkToCrud('Gestion des tags', 'fa-solid fa-hashtag', Tag::class);
        yield MenuItem::linkToCrud('Gestion des utilisateurs', 'fa-solid fa-user', User::class);
        yield MenuItem::linkToCrud('Gestion des messages', 'fa-solid fa-comment-dots', Contact::class);
    }
}
