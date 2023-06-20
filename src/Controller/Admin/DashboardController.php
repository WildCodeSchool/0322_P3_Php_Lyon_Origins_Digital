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

class DashboardController extends AbstractDashboardController
{
    public function __construct()
    {
    }

    #[Route('/admin', name: 'admin_dashboard')]
    public function index(): Response
    {
        // return parent::index();

        // $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        // $url = $routeBuilder->setController(VideoCrudController::class)->generateUrl();

        // return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
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
