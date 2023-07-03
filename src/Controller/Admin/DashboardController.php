<?php

namespace App\Controller\Admin;

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
            'Videos by Tag',
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
            'Favorites by Video',
            $videoTitles,
            $favCount,
        );

        $chartViewsByVideo = $this->chartManager->createBarChartBy(
            'Views by Video',
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
            ->setTitle('Gaming Gurus Dashboard');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa-solid fa-gear');
        yield MenuItem::linkToRoute('Back to the website', 'fa-solid fa-house', 'home_index');
        yield MenuItem::linkToCrud('Manage Videos', 'fa-solid fa-play', Video::class);
        yield MenuItem::linkToRoute('Upload Videos', 'fa-solid fa-file-arrow-up', 'upload_video');
        yield MenuItem::linkToCrud('Manage Tags', 'fa-solid fa-hashtag', Tag::class);
        yield MenuItem::linkToCrud('Manage Users', 'fa-solid fa-user', User::class);
    }
}
