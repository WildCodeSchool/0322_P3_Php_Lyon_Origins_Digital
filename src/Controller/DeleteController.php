<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Video;
use App\Repository\ViewedRepository;
use App\Service\DeleteService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/delete', name: 'delete_')]
class DeleteController extends AbstractController
{
    //route to delete a user by id
    #[Route('/user/{idUser<^[0-9]+$>}', name: 'user')]
    #[ParamConverter('user', class: 'App\Entity\User', options: ['id' => 'idUser'])]
    public function deleteUser(User $user, DeleteService $deleteService): Response
    {
        $deleteService->deleteUser($user);
        $this->addFlash('success', 'Utilisateur supprimé avec succès');

        return $this->redirectToRoute('admin_dashboard');
    }

    //route to delete a video by id
    #[Route('/video/{idVideo<^[0-9]+$>}', name: 'video')]
    #[ParamConverter('video', class: 'App\Entity\Video', options: ['id' => 'idVideo'])]
    public function deleteVideo(
        Video $video,
        DeleteService $deleteService,
        ViewedRepository $viewedRepository
    ): Response {
        $deleteService->deleteVideo($video, $viewedRepository);
        $this->addFlash('success', 'Vidéo supprimée avec succès');

        return $this->redirectToRoute('admin_dashboard');
    }
}
