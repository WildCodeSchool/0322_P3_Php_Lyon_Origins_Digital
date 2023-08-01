<?php

namespace App\Entity;

use App\Repository\ViewedRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

#[ORM\Entity(repositoryClass: ViewedRepository::class)]
class Viewed
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'vieweds')]
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'vieweds')]
    #[JoinColumn(name: 'video_id', referencedColumnName: 'id')]
    private ?Video $video = null;

    #[ORM\Column]
    private ?DateTimeImmutable $viewDate = null;

    public function __construct()
    {
        $this->viewDate = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getVideo(): ?Video
    {
        return $this->video;
    }

    public function setVideo(?Video $video): static
    {
        $this->video = $video;

        return $this;
    }

    public function getViewDate(): ?DateTimeImmutable
    {
        return $this->viewDate;
    }

    public function setViewDate(DateTimeImmutable $viewDate): static
    {
        $this->viewDate = $viewDate;

        return $this;
    }
}
