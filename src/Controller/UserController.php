<?php

namespace App\Controller;

use App\Form\AvatarType;
use App\Repository\UserRepository;
use App\Repository\VideoRepository;
use App\Repository\ViewedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Filesystem\Filesystem;

#[IsGranted('ROLE_USER')]
#[Route('/user', name: 'user_')]
class UserController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(
        ViewedRepository $viewedRepository,
        VideoRepository $videoRepository,
        UserRepository $userRepository,
        SessionInterface $session,
        Request $request,
    ): Response {

        $videoIdList = $viewedRepository->findVideosViewedByUser($this->getUser()->getId());

        $history = [];

        foreach ($videoIdList as $videoId) {
            $history[] = $videoRepository->findOneBy(['id' => $videoId]);
        }

        $user = $this->getUser();
        $form = $this->createForm(AvatarType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $avatarFile */
            $avatarFile = $form->get('avatar')->getData();
            $newFilename = $user->getId() . '.' . $avatarFile->guessExtension();
            if (!is_null($user->getAvatar())) {
                $oldAvatar = $this->getParameter('avatar_directory') . '/' . $user->getAvatar();
                unlink($oldAvatar);
            }
            $avatarFile->move($this->getParameter('avatar_directory'), $newFilename);
            $user->setAvatar($newFilename);
            $userRepository->save($user, true);

            return $this->redirectToRoute('user_dashboard');
        }

        if ($this->isGranted('ROLE_ADMIN') && $session->get('after_login')) {
            $session->set('after_login', false);

            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('user/index.html.twig', [
            'history' => $history,
            'form' => $form,
        ]);
    }
}
