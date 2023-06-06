<?php

namespace App\Controller;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/video', name: 'video_')]
class VideoController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(VideoRepository $videoRepository): Response
    {
        $videos = $videoRepository->findLatestVideos();

        return $this->render('video/index.html.twig', [
            'videos' => $videos
        ]);
    }
}
