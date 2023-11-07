<?php

namespace App\Entity;

use App\Repository\UsersOutsideRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersOutsideRepository::class)]
class UsersOutside
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Users::class, inversedBy: 'usersOutsides')]
    private Collection $user;

    #[ORM\ManyToMany(targetEntity: Outside::class, inversedBy: 'usersOutsides')]
    private Collection $outside;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->outside = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(Users $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(Users $user): static
    {
        $this->user->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, Outside>
     */
    public function getOutside(): Collection
    {
        return $this->outside;
    }

    public function addOutside(Outside $outside): static
    {
        if (!$this->outside->contains($outside)) {
            $this->outside->add($outside);
        }

        return $this;
    }

    public function removeOutside(Outside $outside): static
    {
        $this->outside->removeElement($outside);

        return $this;
    }
}
