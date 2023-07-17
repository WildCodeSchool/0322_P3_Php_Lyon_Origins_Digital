<?php

namespace App\Controller;

use App\Controller\Admin\UserCrudController;
use App\Controller\Admin\VideoCrudController;
use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Video;
use App\Repository\ViewedRepository;
use App\Service\DeleteService;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/delete', name: 'delete_')]
class DeleteController extends AbstractController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    //route to delete a user by id
    #[Route('/user/{idUser<^[0-9]+$>}', name: 'user')]
    #[ParamConverter('user', class: 'App\Entity\User', options: ['id' => 'idUser'])]
    public function deleteUser(
        User $user,
        DeleteService $deleteService
    ): Response {
        $url = $this->adminUrlGenerator
        ->setController(UserCrudController::class)
        ->setAction(Action::INDEX)
        ->generateUrl();

        if ($this->getUser() == $user) {
            $this->addFlash('danger', 'Vous ne pouvez pas supprimer votre propre compte. 
            Cela doit être fait par un autre administrateur');

            return new RedirectResponse($url);
        }

        $deleteService->deleteUser($user);
        $this->addFlash('success', 'Utilisateur supprimé avec succès');

        return new RedirectResponse($url);
    }

    //route to delete a video by id
    #[Route('/video/{idVideo<^[0-9]+$>}', name: 'video')]
    #[ParamConverter('video', class: 'App\Entity\Video', options: ['id' => 'idVideo'])]
    public function deleteVideo(
        Video $video,
        DeleteService $deleteService,
        ViewedRepository $viewedRepository,
    ): Response {
        $url = $this->adminUrlGenerator
        ->setController(VideoCrudController::class)
        ->setAction(Action::INDEX)
        ->generateUrl();

        if ($video->isIsHeader()) {
            $this->addFlash('danger', 'Cette vidéo est le header de la page d\'accueil.
            Sélectionnez une autre vidéo en header pour pouvoir supprimer celle-ci.');

            return new RedirectResponse($url);
        }

        $deleteService->deleteVideo($video, $viewedRepository);
        $this->addFlash('success', 'Vidéo supprimée avec succès');

        return new RedirectResponse($url);
    }

    //route to delete a comment by id
    #[Route('/comment/{commentId<^[0-9]+$>}', name: 'comment')]
    #[ParamConverter('comment', class: 'App\Entity\Comment', options: ['id' => 'commentId'])]
    public function deleteComment(Comment $comment, DeleteService $deleteService): Response
    {
        $video = $deleteService->deleteComment($comment);
        $this->addFlash('success', 'Commentaire supprimé avec succès');

        return $this->redirectToRoute('video_show', ['id' => $video->getId()]);
    }
}
