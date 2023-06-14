<?php

namespace App\Controller;

use App\Entity\Video;
use App\Form\VideoType;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    #[Route('/upload', name: 'upload_video')]
    public function index(Request $request, VideoRepository $videoRepository, RequestStack $requestStack): Response
    {
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session = $requestStack->getSession();
            if ($session->has('fileName')) {
                $fileName = $session->get('fileName');
                $video = $form->getData();
                $video->setVideoUrl($fileName);
                $videoRepository->save($video, true);
                $source = $this->getParameter('temp_directory') . '/' . $fileName;
                $destination = $this->getParameter('video_directory') . '/' . $fileName;
                rename($source, $destination);
                $session->remove('fileName');
            }
            return $this->redirectToRoute('home_index');
        }
        return $this->render('upload/index.html.twig', [
            'form' => $form,
        ]);
    }
}
