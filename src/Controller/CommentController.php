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
use Symfony\Component\HttpFoundation\JsonResponse;

class CommentController extends AbstractController
{
    #[Route('/comment/{videoId<^[0-9]+$>}', methods: ['POST'], name: 'comment_video')]
    #[ParamConverter('video', class: 'App\Entity\Video', options: ['id' => 'videoId'])]
    public function saveComment(Video $video, Request $request, CommentRepository $commentRepository): JsonResponse
    {
        $commentToSave = $request->getContent();

        $newComment = new Comment();
        $newComment
            ->setPostDate(new DateTimeImmutable())
            ->setUser($this->getUser())
            ->setContent($commentToSave)
            ->setVideo($video)
        ;
        $commentRepository->save($newComment, true);

        $datas = [
            'user' => $this->getUser()->getUsername(),
            'date' => $newComment->getPostDate()->format('j M. Y, H:i'),
            'comment' => $commentToSave
        ];

        return $this->json($datas);
    }
}
