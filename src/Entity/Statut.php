<?php

namespace App\Entity;

use App\Repository\StatutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutRepository::class)]
class Statut
{
    public const CREEE = 'Creee';
    public const PUBLIER = 'Ouverte';
    public const TERMINER = 'Cloturee';
    public const ACTIVE = 'Activite en cours';
    public const ANNULEE = 'Annulee';
    public const PASSEE = 'Passee';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $wording = null;

    #[ORM\OneToMany(mappedBy: 'statut', targetEntity: Outside::class)]
    private Collection $outsides;

    public function __construct()
    {
        $this->outsides = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWording(): ?string
    {
        return $this->wording;
    }

    public function setWording(string $wording): static
    {
        $this->wording = $wording;

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
            $outside->setStatut($this);
        }

        return $this;
    }

    public function removeOutside(Outside $outside): static
    {
        if ($this->outsides->removeElement($outside)) {
            // set the owning side to null (unless already changed)
            if ($outside->getStatut() === $this) {
                $outside->setStatut(null);
            }
        }

        return $this;
    }
}
