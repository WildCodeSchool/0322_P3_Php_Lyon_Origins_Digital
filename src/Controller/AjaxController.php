<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends AbstractController
{
    #[Route('/search-videos/{keyword}', name: 'search_videos')]
    public function searchVideos(
        string $keyword,
        VideoRepository $videoRepository
    ): JsonResponse {
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

        return $this->json($searchResults);
    }
}
