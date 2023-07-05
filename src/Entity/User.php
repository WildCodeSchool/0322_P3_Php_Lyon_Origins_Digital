<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $isVerified = false;

    #[ORM\ManyToMany(targetEntity: Video::class, inversedBy: "usersViewLater", cascade: ["persist", "remove"])]
    #[ORM\JoinTable(name: "user_video_view_later")]
    private ?Collection $viewLaterVideos = null;

    #[ORM\ManyToMany(targetEntity: Video::class, inversedBy: "usersFavorited", cascade: ["persist", "remove"])]
    #[ORM\JoinTable(name: "user_video_favorites")]
    private ?Collection $favoriteVideos = null;

    #[ORM\Column(length: 100)]
    #[Assert\Length(
        min: 5,
        max: 100,
        minMessage: 'Vous devez saisir au moins {{ limit }} caractères',
        maxMessage: 'Vous devez saisir au plus {{ limit }} caractères',
    )]
    private ?string $username = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Viewed::class)]
    private Collection $vieweds;
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    #[ORM\Column]
    private ?bool $isAdmin = null;

    public function __construct()
    {
        $this->viewLaterVideos = new ArrayCollection();
        $this->favoriteVideos = new ArrayCollection();
        $this->vieweds = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        // add ROLE_ADMIN for users granted in EasyAdmin board
        if ($this->isAdmin) {
            $roles[] = 'ROLE_ADMIN';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getViewLaterVideos(): Collection
    {
        return $this->viewLaterVideos;
    }

    public function addViewLaterVideo(Video $video): void
    {
        if (!$this->viewLaterVideos->contains($video)) {
            $this->viewLaterVideos[] = $video;
            $video->addUserViewLater($this);
        }
    }

    public function removeViewLaterVideo(Video $video): void
    {
        if ($this->viewLaterVideos->contains($video)) {
            $this->viewLaterVideos->removeElement($video);
            $video->removeUserViewLater($this);
        }
    }

    public function getFavoriteVideos(): Collection
    {
        return $this->favoriteVideos;
    }

    public function addFavoriteVideo(Video $video): void
    {
        if (!$this->favoriteVideos->contains($video)) {
            $this->favoriteVideos[] = $video;
            $video->addUserFavorited($this);
        }
    }

    public function removeFavoriteVideo(Video $video): void
    {
        if ($this->favoriteVideos->contains($video)) {
            $this->favoriteVideos->removeElement($video);
            $video->removeUserFavorited($this);
        }
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
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
            $viewed->setUser($this);
        }

        return $this;
    }

    public function removeViewed(Viewed $viewed): static
    {
        if ($this->vieweds->removeElement($viewed)) {
            // set the owning side to null (unless already changed)
            if ($viewed->getUser() === $this) {
                $viewed->setUser(null);
            }
        }

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
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
// set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    public function isIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): static
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }
}
