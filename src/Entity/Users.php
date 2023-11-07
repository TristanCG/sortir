<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $password = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nickname = null;

    #[ORM\ManyToOne(inversedBy: 'fk_user')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Campus $campus = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rank $grade = null;

    #[ORM\OneToMany(mappedBy: 'promoter', targetEntity: Outside::class)]
    private Collection $outsides;

    #[ORM\ManyToMany(targetEntity: UsersOutside::class, mappedBy: 'user')]
    private Collection $usersOutsides;

    public function __construct()
    {
        $this->outsides = new ArrayCollection();
        $this->usersOutsides = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(?string $nickname): static
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getCampus(): ?Campus
    {
        return $this->campus;
    }

    public function setCampus(?Campus $campus): static
    {
        $this->campus = $campus;

        return $this;
    }

    public function getGrade(): ?Rank
    {
        return $this->grade;
    }

    public function setGrade(?Rank $grade): static
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * @return Collection<int, Outside>
     */
    public function getOutsides(): Collection
    {
        return $this->outsides;
    }

    public function addOutside(Outside $outside): static
    {
        if (!$this->outsides->contains($outside)) {
            $this->outsides->add($outside);
            $outside->setPromoter($this);
        }

        return $this;
    }

    public function removeOutside(Outside $outside): static
    {
        if ($this->outsides->removeElement($outside)) {
            // set the owning side to null (unless already changed)
            if ($outside->getPromoter() === $this) {
                $outside->setPromoter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UsersOutside>
     */
    public function getUsersOutsides(): Collection
    {
        return $this->usersOutsides;
    }

    public function addUsersOutside(UsersOutside $usersOutside): static
    {
        if (!$this->usersOutsides->contains($usersOutside)) {
            $this->usersOutsides->add($usersOutside);
            $usersOutside->addUser($this);
        }

        return $this;
    }

    public function removeUsersOutside(UsersOutside $usersOutside): static
    {
        if ($this->usersOutsides->removeElement($usersOutside)) {
            $usersOutside->removeUser($this);
        }

        return $this;
    }


}
