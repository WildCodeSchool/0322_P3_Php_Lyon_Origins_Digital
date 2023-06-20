<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Entity\Video;
use App\Repository\TagRepository;
use App\Repository\VideoRepository;
use App\Service\ChartManager;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private ChartBuilderInterface $chartBuilder,
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
        foreach ($tags as $tag) {
            $tagNames[] = $tag->getName();
            $tagVideoCount[] = count($tag->getVideos());
        }

        $chartVideosByTag = $this->chartManager->createBarChartBy(
            $tagNames, 
            $tagVideoCount,
            'Videos by Tag'
        );

        // --------------------------------------------------------
        
        $videos = $this->videoRepository->findAll();
        foreach ($videos as $video) {
            $videoTitles[] = substr($video->getTitle(), 0, 10) . '...';
            $favCount[] = count($video->getUsersFavorited());
        }

        $chartFavoritesByVideo = $this->chartManager->createBarChartBy(
            $videoTitles, 
            $favCount,
            'Favorites by Video'
        );

        // --------------------------------------------------------
        
        $videos = $this->videoRepository->findAll();
        foreach ($videos as $video) {
            $videoTitles[] = substr($video->getTitle(), 0, 10) . '...';
            $ViewsCount[] = count($video->getUsersViewed());
        }

        $chartViewsByVideo = $this->chartManager->createBarChartBy(
            $videoTitles, 
            $ViewsCount,
            'Views by Video'
        );

        // --------------------------------------------------------
        
        $videos = $this->videoRepository->findAll();
        foreach ($videos as $video) {
            $videoTitles[] = substr($video->getTitle(), 0, 10) . '...';
            $LikesCount[] = count($video->getUsersLiked());
        }

        $chartLikesByVideo = $this->chartManager->createBarChartBy(
            $videoTitles, 
            $LikesCount,
            'Likes by Video'
        );

        // --------------------------------------------------------

        return $this->render('admin/dashboard.html.twig', [
            'chartVideosByTag' => $chartVideosByTag,
            'chartFavoritesByVideo' => $chartFavoritesByVideo,
            'chartViewsByVideo' => $chartViewsByVideo,
            'chartLikesByVideo' => $chartLikesByVideo,
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
        yield MenuItem::linkToRoute('Upload Videos', 'fa-solid fa-play', 'upload_video');
        yield MenuItem::linkToCrud('Manage Tags', 'fa-solid fa-hashtag', Tag::class);
    }


}
