<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Video;
use App\Repository\ViewedRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class DeleteService
{
    public function __construct(private EntityManagerInterface $entityManager, private ParameterBagInterface $params)
    {
        $this->entityManager = $entityManager;
        $this->params = $params;
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

    public function deleteVideo(Video $video, ViewedRepository $viewedRepository): void
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

        $videoFile = $this->params->get('video_directory') . '/' . $video->getVideoUrl();
        $imageFile = $this->params->get('image_directory') . '/' . $video->getPosterUrl();

        if (file_exists($videoFile)) {
            unlink($videoFile);
        }
        if (file_exists($imageFile)) {
            unlink($imageFile);
        }

        $this->entityManager->remove($video);
        $this->entityManager->flush();
        $viewedRepository->deleteNullUserAndNullVideo();
    }
}
