<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'home_')]
class HomeController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(VideoRepository $videoRepository): Response
    {
        $latestVideos = $videoRepository->findLatestVideos();

        return $this->render('home/index.html.twig', [
            'latestVideos' => $latestVideos
        ]);
    }
}
