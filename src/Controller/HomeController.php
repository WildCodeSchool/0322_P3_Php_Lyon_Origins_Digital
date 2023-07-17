<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use App\Repository\ViewedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'home_')]
class HomeController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(VideoRepository $videoRepository, ViewedRepository $viewedRepository): Response
    {
        $latestVideos = $videoRepository->findLatestVideos();
        $mostVieweds = $viewedRepository->findMostViewed(50);

        $trendingTags = [];
        foreach ($mostVieweds as $mostViewed) {
            $trendingTags[] = $videoRepository->findOneBy(['id' => $mostViewed['id']])->getTag()[0]->getName();
        }
        $trendingTags = array_unique($trendingTags);

        $headerVideo = $videoRepository->findOneBy(['isHeader' => true]);
        if (is_null(($headerVideo))) {
            $this->addFlash('danger', 'Cette vidéo n\'est pas encore publiée et ne peut pas être mise en entête.');
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('home/index.html.twig', [
            'trendingTags' => $trendingTags,
            'latestVideos' => $latestVideos,
            'headerVideo' => $headerVideo
        ]);
    }
}
