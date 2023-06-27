<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;

class DeleteService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function deleteUser(User $user): void
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
    }

    public function deleteVideo(Video $video): void
    {
        foreach ($video->getVieweds() as $viewed) {
            $user = $viewed->getUser();
            if ($user) {
                $user->removeViewed($viewed);
            }
            $video->removeViewed($viewed);
        }

        $viewedLaterVideos = $video->getUsersViewLater();
        foreach ($viewedLaterVideos as $viewedLaterVideo) {
            $viewedLaterVideo->removeViewLaterVideo($video);
        }

        $favoriteVideos = $video->getUsersFavorited();
        foreach ($favoriteVideos as $favoriteVideo) {
            $favoriteVideo->removeFavoriteVideo($video);
        }

            $this->entityManager->remove($video);
            $this->entityManager->flush();
    }
}
