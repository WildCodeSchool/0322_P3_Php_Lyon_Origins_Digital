<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Video;
use App\Repository\TagRepository;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/video', name: 'video_')]
class VideoController extends AbstractController
{
    #[Route('/show/{id<^[0-9]+$>}', methods: ['GET'], name: 'show')]
    public function show(
        User $user,
        Video $video,
        VideoRepository $videoRepository,
        TagRepository $tagRepository
    ): Response {
        $latestVideos = $videoRepository->findLatestVideos();
        $mobaVideos = $videoRepository->findLatestVideos();
        $tags = $tagRepository->findAll();

        return $this->render('video/show.html.twig', [
            'video' => $video,
            'latestVideos' => $latestVideos,
            'mobaVideos' => $mobaVideos,
            'tags' => $tags,
            'user' => $user
        ]);
    }
}
