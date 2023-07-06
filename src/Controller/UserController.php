<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use App\Repository\ViewedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/user', name: 'user_')]
class UserController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(
        ViewedRepository $viewedRepository,
        VideoRepository $videoRepository
    ): Response {
        $videoIdList = $viewedRepository->findVideosViewedByUser($this->getUser()->getId());

        $history = [];

        foreach ($videoIdList as $videoId) {
            $history[] = $videoRepository->findOneBy(['id' => $videoId]);
        }

        return $this->render('user/index.html.twig', [
            'history' => $history,
        ]);
    }
}
