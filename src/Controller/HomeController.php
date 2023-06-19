<?php

namespace App\Controller;

use App\Repository\TagRepository;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'home_')]
class HomeController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(VideoRepository $videoRepository, TagRepository $tagRepository): Response
    {
        $latestVideos = $videoRepository->findLatestVideos();
        $trendingTags = $tagRepository->findAll();
        $headerVideo = $videoRepository->findAll();

        return $this->render('home/index.html.twig', [
            'trendingTags' => $trendingTags,
            'latestVideos' => $latestVideos,
            'headerVideo' => $headerVideo
        ]);
    }
}
