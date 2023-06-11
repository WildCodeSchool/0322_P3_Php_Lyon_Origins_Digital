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
    #[Route('/show/{id<^[0-9]+$>}', methods: ['GET'], name: 'show')]
    public function show(Video $video, VideoRepository $videoRepository): Response
    {
        $latestVideos = $videoRepository->findLatestVideos();
        $mobaVideos = $videoRepository->findLatestVideos();

        return $this->render('video/show.html.twig', [
            'video' => $video,
            'latestVideos' => $latestVideos,
            'mobaVideos' => $mobaVideos,
        ]);
    }
}
