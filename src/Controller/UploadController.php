<?php

namespace App\Controller;

use App\Entity\Video;
use App\Form\VideoType;
use App\Repository\VideoRepository;
use App\Service\SaveVideoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    #[Route('/upload', name: 'upload_video')]
    public function index(
        Request $request,
        VideoRepository $videoRepository,
        SaveVideoService $saveVideoService
    ): Response {

        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fileName = $saveVideoService->getVideoName();
            if (!empty($fileName)) {
                $video = $form->getData();
                $video->setVideoUrl($fileName);
                $video->setPosterUrl('blank.jpg'); //This line have to be deleted when new videos will have their thumb

                $saveVideoService->saveVideoFile($fileName);
                $videoRepository->save($video, true);
                $this->addFlash('success', 'Vidéo ajoutée avec succès');
            } else {
                $this->addFlash('danger', 'Erreur: La vidéo n\'a pas pu être ajoutée');
            }
            return $this->redirectToRoute('home_index');
        }
        $saveVideoService->deleteSessionFilename();
        return $this->render('upload/index.html.twig', [
            'form' => $form,
        ]);
    }
}
