<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Video;
use DateTimeImmutable;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
            // $this->redirectToRoute($request->attributes->get('_route'), ['id' => $video->getId()]);
        }

        return $commentForm;
    }
}
