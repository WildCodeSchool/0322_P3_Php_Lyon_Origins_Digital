<?php

namespace App\Controller;

use App\Entity\Video;
use App\Repository\ViewedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;

class ViewedController extends AbstractController
{
    #[Route('/viewed/{videoId<^[0-9]+$>}', name: 'app_viewed')]
    #[ParamConverter('video', class: 'App\Entity\Video', options: ['id' => 'videoId'])]
    public function viewed(Video $video, ViewedRepository $viewedRepository): JsonResponse
    {
        $viewed = $viewedRepository->findView($video->getId());
        return new JsonResponse($viewed);
    }
}
