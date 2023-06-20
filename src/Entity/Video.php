<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable as Date;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length(
        min: 15,
        max: 400,
        minMessage: 'Vous devez saisir au moins {{ limit }} caractères',
        maxMessage: 'Vous devez saisir au plus {{ limit }} caractères',
    )]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 5,
        max: 255,
        minMessage: 'Vous devez saisir au moins {{ limit }} caractères',
        maxMessage: 'Vous devez saisir au plus {{ limit }} caractères',
    )]
    private ?string $title = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $postDate = null;

    #[ORM\Column(length: 255)]
    private ?string $videoUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $posterUrl = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'videos')]
    private Collection $tag;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: "viewedVideos", cascade: ["persist", "remove"])]
    private ?Collection $usersViewed = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: "likedVideos", cascade: ["persist", "remove"])]
    private ?Collection $usersLiked = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: "viewLaterVideos", cascade: ["persist", "remove"])]
    private ?Collection $usersViewLater = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: "favoriteVideos", cascade: ["persist", "remove"])]
    private ?Collection $usersFavorited = null;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
        $this->postDate = new Date();
        $this->usersViewed = new ArrayCollection();
        $this->usersLiked = new ArrayCollection();
        $this->usersViewLater = new ArrayCollection();
        $this->usersFavorited = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPostDate(): ?\DateTimeImmutable
    {
        return $this->postDate;
    }

    public function setPostDate(\DateTimeImmutable $postDate): self
    {
        $this->postDate = $postDate;

        return $this;
    }

    public function getVideoUrl(): ?string
    {
        return $this->videoUrl;
    }

    public function setVideoUrl(string $videoUrl): self
    {
        $this->videoUrl = $videoUrl;

        return $this;
    }

    public function getPosterUrl(): ?string
    {
        return $this->posterUrl;
    }

    public function setPosterUrl(string $posterUrl): self
    {
        $this->posterUrl = $posterUrl;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tag->contains($tag)) {
            $this->tag->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tag->removeElement($tag);
        return $this;
    }

    public function getUsersViewed(): Collection
    {
        return $this->usersViewed;
    }

    public function addUserViewed(User $user): void
    {
        if (!$this->usersViewed->contains($user)) {
            $this->usersViewed->add($user);
            $user->addViewedVideo($this);
        }
    }

    public function removeUserViewed(User $user): void
    {
        if ($this->usersViewed->contains($user)) {
            $this->usersViewed->removeElement($user);
            $user->removeViewedVideo($this);
        }
    }

    public function getUsersLiked(): Collection
    {
        return $this->usersLiked;
    }

    public function addUserLiked(User $user): void
    {
        if (!$this->usersLiked->contains($user)) {
            $this->usersLiked[] = $user;
            $user->addLikedVideo($this);
        }
    }

    public function removeUserLiked(User $user): void
    {
        if ($this->usersLiked->contains($user)) {
            $this->usersLiked->removeElement($user);
            $user->removeLikedVideo($this);
        }
    }

    public function getUsersViewLater(): Collection
    {
        return $this->usersViewLater;
    }

    public function addUserViewLater(User $user): void
    {
        if (!$this->usersViewLater->contains($user)) {
            $this->usersViewLater[] = $user;
            $user->addViewLaterVideo($this);
        }
    }

    public function removeUserViewLater(User $user): void
    {
        if ($this->usersViewLater->contains($user)) {
            $this->usersViewLater->removeElement($user);
            $user->removeViewLaterVideo($this);
        }
    }

    public function getUsersFavorited(): Collection
    {
        return $this->usersFavorited;
    }

    public function addUserFavorited(User $user): void
    {
        if (!$this->usersFavorited->contains($user)) {
            $this->usersFavorited[] = $user;
            $user->addFavoriteVideo($this);
        }
    }

    public function removeUserFavorited(User $user): void
    {
        if ($this->usersFavorited->contains($user)) {
            $this->usersFavorited->removeElement($user);
            $user->removeFavoriteVideo($this);
        }
    }
}
