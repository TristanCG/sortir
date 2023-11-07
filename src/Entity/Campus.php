<?php

namespace App\Entity;

use App\Repository\CampusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampusRepository::class)]
class Campus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'campus', targetEntity: Outside::class)]
    private Collection $outsides;

    #[ORM\OneToMany(mappedBy: 'campus', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {

        $this->outsides = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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
            $outside->setCampus($this);
        }

        return $this;
    }

    public function removeOutside(Outside $outside): static
    {
        if ($this->outsides->removeElement($outside)) {
            // set the owning side to null (unless already changed)
            if ($outside->getCampus() === $this) {
                $outside->setCampus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setCampus($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCampus() === $this) {
                $user->setCampus(null);
            }
        }

        return $this;
    }
}
