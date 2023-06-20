<?php

namespace App\Controller;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

#[Route('/fav', name: 'fav_')]
class FavoriteController extends AbstractController
{
    #[Route('/{idVideo<^[0-9]+$>}', name: 'add')]
    #[ParamConverter('video', class: 'App\Entity\Video', options: ['id' => 'idVideo'])]
    public function index(Video $video, VideoRepository $videoRepository): Response
    {
        if ($this->getUser()) {
            $user = $this->getUser();

            if ($video->getUsersFavorited()->contains($user)) {
                $video->removeUserFavorited($user);
            } else {
                $video->addUserFavorited($user);
            }
            $videoRepository->save($video, true);
        }
        return new Response(status: 200);
    }
}
