<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/big-thumbnail', name: 'big_thumbnail')]
    public function bigThumbnail(VideoRepository $videoRepository): Response
    {
        $video = $videoRepository->find(1);

        return $this->render('shared/big-thumbnail.html.twig', [
            'video' => $video,
        ]);
    }
}
