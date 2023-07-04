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
use DateTimeZone;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends AbstractController
{
    #[Route('/comment/{videoId<^[0-9]+$>}', methods: ['POST'], name: 'comment_video')]
    #[ParamConverter('video', class: 'App\Entity\Video', options: ['id' => 'videoId'])]
    public function saveComment(Video $video, Request $request, CommentRepository $commentRepository): Response
    {
        $commentToSave = $request->getContent();

        dd($commentToSave);

        $newComment = new Comment();
        $newComment
            ->setPostDate(new DateTimeImmutable())
            ->setUser($this->getUser())
            ->setContent($commentToSave)
            ->setVideo($video)
        ;
        $commentRepository->save($newComment, true);

        $timezone = new DateTimeZone('Europe/Paris');
        $datas = [
            'user' => $this->getUser(),
            'postDate' => $newComment->getPostDate()->setTimezone($timezone)->format('j M. Y, H:i'),
            'content' => $commentToSave
        ];

        return $this->render('/shared/comment/comment.html.twig', [
            'comment' => $datas,
        ]);
    }
}
