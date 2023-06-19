<?php

namespace App\Controller;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/later', name: 'later_')]
class ViewLaterController extends AbstractController
{
    #[Route('/{idVideo<^[0-9]+$>}', name: 'add')]
    public function index(Video $idVideo, VideoRepository $videoRepository): Response
    {
        if ($this->getUser()) {
            $user = $this->getUser();

            if ($idVideo->getUsersViewLater()->contains($user)) {
                $idVideo->removeUserViewLater($user);
            } else {
                $idVideo->addUserViewLater($user);
            }
            $videoRepository->save($idVideo, true);
        }
        return new Response(status: 200);
    }
}
