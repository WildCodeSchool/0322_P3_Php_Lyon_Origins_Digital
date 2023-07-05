<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoSearchController extends AbstractController
{
    #[Route('/search-videos/{keyword}', name: 'search_videos')]
    public function searchVideos(
        string $keyword,
        VideoRepository $videoRepository
    ): Response {
        $searchVideos = $videoRepository->findVideosBySearch($keyword);

        $searchResults = [];

        foreach ($searchVideos as $searchVideo) {
            foreach ($searchVideo->getTag() as $videoTag) {
                $searchResults[] = [
                    'id' => $searchVideo->getId(),
                    'title' => $searchVideo->getTitle(),
                    'posterUrl' => $searchVideo->getPosterUrl(),
                    'description' => $searchVideo->getDescription(),
                    'tag' => $videoTag->getName(),
                ];
            }
        };

        return $this->render('video_search/search-result.html.twig', [
            'searchResults' => $searchResults
        ]);
    }
}
