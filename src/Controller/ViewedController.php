<?php

namespace App\Controller;

use App\Repository\ViewedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ViewedController extends AbstractController
{
    #[Route('/viewed', name: 'app_viewed', methods: ['POST'])]
    public function viewed(Request $request, ViewedRepository $viewedRepository): JsonResponse
    {
        $datas = $request->toArray();
        $response = [];
        foreach ($datas as $data) {
            $viewed = $viewedRepository->findView((int)$data);
            $response[] = [$data => strval($viewed[0][1])];
        }
        return $this->json($response);
    }
}
