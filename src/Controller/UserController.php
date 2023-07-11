<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AvatarType;
use App\Repository\UserRepository;
use App\Repository\VideoRepository;
use App\Repository\ViewedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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
        Filesystem $filesystem,
        Request $request,
        SluggerInterface $slugger,
    ): Response {

        $videoIdList = $viewedRepository->findVideosViewedByUser($this->getUser()->getId());

        $history = [];

        foreach ($videoIdList as $videoId) {
            $history[] = $videoRepository->findOneBy(['id' => $videoId]);
        }

        if ($this->isGranted('ROLE_ADMIN') && $session->get('after_login')) {
            $session->set('after_login', false);

            return $this->redirectToRoute('admin_dashboard');
        }

        $user = $this->getUser();
        $form = $this->createForm(AvatarType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $avatarFile */
            $avatarFile = $form->get('avatar')->getData();

                $originalFilename = pathinfo($avatarFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $avatarFile->guessExtension();
            if ($user->getAvatar() !== null) {
                if ($filesystem->exists($this->getParameter('avatar_directory') . '/' . $user->getAvatar())) {
                    $filesystem->remove($this->getParameter('avatar_directory') . '/' . $user->getAvatar());
                }
            }
                $avatarFile->move($this->getParameter('avatar_directory'), $newFilename);
                $user->setAvatar($newFilename);
                $userRepository->save($user, true);

                return $this->redirectToRoute('user_dashboard');
        }

        return $this->render('user/index.html.twig', [
            'history' => $history,
            'form' => $form,
        ]);
    }
}
