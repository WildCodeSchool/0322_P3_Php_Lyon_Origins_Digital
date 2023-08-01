<?php

namespace App\Controller;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/later', name: 'later_')]
class ViewLaterController extends AbstractController
{
    #[Route('/{idVideo<^[0-9]+$>}', name: 'add')]
    #[ParamConverter('video', class: 'App\Entity\Video', options: ['id' => 'idVideo'])]
    public function index(Video $video, VideoRepository $videoRepository): Response
    {
        if ($this->getUser()) {
            $user = $this->getUser();

            if ($video->getUsersViewLater()->contains($user)) {
                $video->removeUserViewLater($user);
            } else {
                $video->addUserViewLater($user);
            }
            $videoRepository->save($video, true);
        }
        return new Response(status: 200);
    }
}
