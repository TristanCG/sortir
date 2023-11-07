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

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Users::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'campus', targetEntity: Users::class)]
    private Collection $fk_user;

    #[ORM\OneToMany(mappedBy: 'campus', targetEntity: Outside::class)]
    private Collection $outsides;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->fk_user = new ArrayCollection();
        $this->outsides = new ArrayCollection();
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
     * @return Collection<int, Users>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setCategory($this);
        }

        return $this;
    }

    public function removeUser(Users $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCategory() === $this) {
                $user->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getFkUser(): Collection
    {
        return $this->fk_user;
    }

    public function addFkUser(Users $fkUser): static
    {
        if (!$this->fk_user->contains($fkUser)) {
            $this->fk_user->add($fkUser);
            $fkUser->setCampus($this);
        }

        return $this;
    }

    public function removeFkUser(Users $fkUser): static
    {
        if ($this->fk_user->removeElement($fkUser)) {
            // set the owning side to null (unless already changed)
            if ($fkUser->getCampus() === $this) {
                $fkUser->setCampus(null);
            }
        }

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
}
