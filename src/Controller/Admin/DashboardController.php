<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Entity\Video;
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
    public function __construct(private ChartBuilderInterface $chartBuilder)
    {
    }

    #[Route('/admin', name: 'admin_dashboard')]
    public function index(): Response
    {

        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);

        $chart->setData([
            'labels' => ['label 1', 'label 2', 'label 3'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0,1,2,3,4,5,6,7,8,9],
                ],
            ],
        ]);

        // $chart->setOptions([
        //     'scales' => [
        //         'y' => [
        //             'suggestedMin' => 0,
        //             'suggestedMax' => 100,
        //         ]
        //     ]
        // ]);

        return $this->render('admin/dashboard.html.twig', [
            'chart' => $chart,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('0322 P3 Php Lyon Origins Digital');
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
