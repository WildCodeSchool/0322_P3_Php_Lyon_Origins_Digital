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

    #[Route(
        '/show/{id}/',
        requirements: ['id' => '\d+'],
        methods: ['GET'],
        name: 'show',
    )]
    public function show(VideoRepository $videoRepository, int $id = 1): Response
    {
        $video = $videoRepository->find($id);

        return $this->render('video/show.html.twig', [
            'video' => $video,
        ]);
    }
}
