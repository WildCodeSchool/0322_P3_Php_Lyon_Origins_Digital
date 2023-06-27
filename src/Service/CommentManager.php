<?php

namespace App\Service;

use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Video;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentManager extends AbstractController
{
    public function postComment(
        Request $request,
        CommentRepository $commentRepository,
        Video $video
    ): FormInterface {
        /** @var User $user */
        $comment = new Comment();

        $comment
            ->setPostDate(new DateTimeImmutable())
            ->setUser($this->getUser())
            ->setVideo($video)
        ;

        $commentForm = $this->createForm(CommentType::class, $comment);

        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $commentRepository->save($comment, true);
        }

        return $commentForm;
    }
}
