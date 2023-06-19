<?php

namespace App\Controller;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/like', name: 'like_')]
class LikeController extends AbstractController
{
    #[Route('/{idVideo<^[0-9]+$>}', name: 'add')]
    public function index(Video $idVideo, VideoRepository $videoRepository): Response
    {
        if ($this->getUser()) {
            $user = $this->getUser();

            if ($idVideo->getUsersLiked()->contains($user)) {
                $idVideo->removeUserLiked($user);
            } else {
                $idVideo->addUserLiked($user);
            }
            $videoRepository->save($idVideo, true);
        }
        return new Response(status: 200);
    }
}
