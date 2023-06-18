<?php

namespace App\Controller;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fav', name: 'fav_')]
class FavoriteController extends AbstractController
{
    #[Route('/{idVideo<^[0-9]+$>}', name: 'add')]
    public function index(Video $idVideo, VideoRepository $videoRepository): Response
    {

        if ($this->getUser()) {
            $user = $this->getUser();

            if ($idVideo->getUsersFavorited()->contains($user)) {
                $idVideo->removeUserFavorited($user);
            } else {
                $idVideo->addUserFavorited($user);
            }
            $videoRepository->save($idVideo, true);
        }

        return $this->redirectToRoute('home_index');
    }
}
