<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
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

    #[ORM\ManyToMany(targetEntity: Video::class, inversedBy: "usersLiked", cascade: ["persist", "remove"])]
    #[ORM\JoinTable(name: "user_video_likes")]
    private ?Collection $likedVideos = null;

    #[ORM\ManyToMany(targetEntity: Video::class, inversedBy: "usersViewLater", cascade: ["persist", "remove"])]
    #[ORM\JoinTable(name: "user_video_view_later")]
    private ?Collection $viewLaterVideos = null;

    #[ORM\ManyToMany(targetEntity: Video::class, inversedBy: "usersFavorited", cascade: ["persist", "remove"])]
    #[ORM\JoinTable(name: "user_video_favorites")]
    private ?Collection $favoriteVideos = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Viewed::class)]
    private Collection $vieweds;

    public function __construct()
    {
        $this->likedVideos = new ArrayCollection();
        $this->viewLaterVideos = new ArrayCollection();
        $this->favoriteVideos = new ArrayCollection();
        $this->vieweds = new ArrayCollection();
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

    public function getLikedVideos(): Collection
    {
        return $this->likedVideos;
    }

    public function addLikedVideo(Video $video): void
    {
        if (!$this->likedVideos->contains($video)) {
            $this->likedVideos[] = $video;
            $video->addUserLiked($this);
        }
    }

    public function removeLikedVideo(Video $video): void
    {
        if ($this->likedVideos->contains($video)) {
            $this->likedVideos->removeElement($video);
            $video->removeUserLiked($this);
        }
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
}
