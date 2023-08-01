<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Video;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class CommentController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/comment/{videoId<^[0-9]+$>}', methods: ['POST'], name: 'comment_video')]
    #[ParamConverter('video', class: 'App\Entity\Video', options: ['id' => 'videoId'])]
    public function saveComment(Video $video, Request $request, CommentRepository $commentRepository): Response
    {
        $commentToSave = $request->getContent();
        $commentToSave = trim($commentToSave, '"');

        $comment = new Comment();
        $comment
            ->setPostDate(new DateTimeImmutable())
            ->setUser($this->getUser())
            ->setContent($commentToSave)
            ->setVideo($video)
        ;
        $commentRepository->save($comment, true);

        return $this->render('/shared/comment/comment.html.twig', [
            'comment' => $comment,
        ]);
    }
}
