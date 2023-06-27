<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    //route to delete a user by id
    #[Route('/delete/user/{idUser<^[0-9]+$>}', name: 'user_delete')]
    #[ParamConverter('user', class: 'App\Entity\User', options: ['id' => 'idUser'])]
    public function deleteUser(User $user): Response
    {
        foreach ($user->getVieweds() as $viewed) {
            $viewed->setUser(null);
        }

            $viewedLaterVideos = $user->getViewLaterVideos();
        foreach ($viewedLaterVideos as $viewedLaterVideo) {
            $user->removeViewLaterVideo($viewedLaterVideo);
        }

            $favoriteVideos = $user->getFavoriteVideos();
        foreach ($favoriteVideos as $favoriteVideo) {
            $user->removeFavoriteVideo($favoriteVideo);
        }

            $this->entityManager->remove($user);
            $this->entityManager->flush();
            $this->addFlash('success', 'Utilisateur supprimé avec succès');

        return $this->redirectToRoute('admin_dashboard');
    }

    //route to delete a video by id
    #[Route('/delete/video/{idVideo<^[0-9]+$>}', name: 'video_delete')]
    #[ParamConverter('video', class: 'App\Entity\Video', options: ['id' => 'idVideo'])]
    public function deleteVideo(Video $video): Response
    {
        foreach ($video->getVieweds() as $viewed) {
            $user = $viewed->getUser();
            $user->removeViewed($viewed);
            $video->removeViewed($viewed);
        }

            $this->entityManager->remove($video);
            $this->entityManager->flush();
            $this->addFlash('success', 'Vidéo supprimée avec succès');

        return $this->redirectToRoute('admin_dashboard');
    }
}
