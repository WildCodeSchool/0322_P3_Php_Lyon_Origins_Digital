<?php

namespace App\Entity;

use App\Entity\Traits;
use App\Repository\VideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Video
{
    use Traits;

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

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: "viewLaterVideos", cascade: ["persist", "remove"])]
    private ?Collection $usersViewLater = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: "favoriteVideos", cascade: ["persist", "remove"])]
    private ?Collection $usersFavorited = null;

    #[ORM\OneToMany(mappedBy: 'video', targetEntity: Viewed::class)]
    private Collection $vieweds;
    #[ORM\OneToMany(mappedBy: 'video', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    #[ORM\Column]
    private ?bool $isPremium = null;
    #[ORM\Column]
    private ?bool $isHeader = false;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
        $this->usersViewLater = new ArrayCollection();
        $this->usersFavorited = new ArrayCollection();
        $this->vieweds = new ArrayCollection();
        $this->comments = new ArrayCollection();
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

    /**
     * @return Collection<int, Viewed>
     */
    public function getVieweds(): Collection
    {
        return $this->vieweds;
    }

    public function addViewed(Viewed $viewed): static
    {
        if (!$this->vieweds->contains($viewed)) {
            $this->vieweds->add($viewed);
            $viewed->setVideo($this);
        }

        return $this;
    }

    public function removeViewed(Viewed $viewed): static
    {
        if ($this->vieweds->removeElement($viewed)) {
            // set the owning side to null (unless already changed)
            if ($viewed->getVideo() === $this) {
                $viewed->setVideo(null);
            }
        }

        return $this;
    }

    public function isIsHeader(): ?bool
    {
        return $this->isHeader;
    }

    public function setIsHeader(bool $isHeader): static
    {
        $this->isHeader = $isHeader;
        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setVideo($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getVideo() === $this) {
                $comment->setVideo(null);
            }
        }

        return $this;
    }

    public function isIsPremium(): ?bool
    {
        return $this->isPremium;
    }

    public function setIsPremium(bool $isPremium): static
    {
        $this->isPremium = $isPremium;
        return $this;
    }
}
