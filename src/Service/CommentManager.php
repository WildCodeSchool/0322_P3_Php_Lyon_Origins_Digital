<?php

namespace App\Service;

use App\Entity\Video;
use DateTimeImmutable;
use App\Entity\Comment;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentManager extends AbstractController
{
    public function __construct(public CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    public function postComment(string $comment, Video $video): void
    {

        $comment = new Comment();

        $comment
            ->setPostDate(new DateTimeImmutable())
            ->setUser($this->getUser())
            ->setVideo($video)
        ;
        $this->commentRepository->save($comment, true);
    }
}
