<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Video;
use App\Repository\UserRepository;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route('/fav', name: 'fav_')]
class FavoriteController extends AbstractController
{
    #[Route('/add/user/{id<\d+>}/video/{idVideo}', name: 'add')]
    public function index(
        #[CurrentUser] ?User $user,
        Request $request,
        int $idVideo,
        UserRepository $userRepository,
        VideoRepository $videoRepository
    ): Response {

        // $uri = $request->getUri();

        $video = $videoRepository->find($idVideo);
        $user->addFavoriteVideo($video);
        $userRepository->save($user, true);

        return $this->redirect('home_index');
    }
}
