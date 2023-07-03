<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Video;
use App\Repository\CommentRepository;
use App\Service\CommentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DateTimeImmutable;

class CommentController extends AbstractController
{
    #[Route('/comment/{videoId<^[0-9]+$>}', methods: ['POST'], name: 'comment_video')]
    #[ParamConverter('video', class: 'App\Entity\Video', options: ['id' => 'videoId'])]
    public function saveComment(Video $video, Request $request, CommentRepository $commentRepository): Response
    {
        $comment = $request->getContent();

        $comment = new Comment();
        $comment
            ->setPostDate(new DateTimeImmutable())
            ->setUser($this->getUser())
            ->setVideo($video)
        ;
        $commentRepository->save($comment, true);

        return new Response("200", Response::HTTP_OK);
    }
}
