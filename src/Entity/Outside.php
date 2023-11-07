<?php

namespace App\Entity;

use App\Repository\OutsideRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OutsideRepository::class)]
class Outside
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateTimeStart = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateLimitRegister = null;

    #[ORM\Column]
    private ?int $registerMax = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $information = null;

    #[ORM\ManyToOne(inversedBy: 'outsides')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Campus $campus = null;

    #[ORM\ManyToOne(inversedBy: 'outsides')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Statut $statut = null;

    #[ORM\ManyToOne(inversedBy: 'outsides')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Place $place = null;

    #[ORM\ManyToOne(inversedBy: 'outsides')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $promoter = null;

    #[ORM\ManyToMany(targetEntity: UsersOutside::class, mappedBy: 'outside')]
    private Collection $usersOutsides;

    public function __construct()
    {
        $this->usersOutsides = new ArrayCollection();
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

    public function getDateTimeStart(): ?\DateTimeInterface
    {
        return $this->dateTimeStart;
    }

    public function setDateTimeStart(\DateTimeInterface $dateTimeStart): static
    {
        $this->dateTimeStart = $dateTimeStart;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDateLimitRegister(): ?\DateTimeInterface
    {
        return $this->dateLimitRegister;
    }

    public function setDateLimitRegister(\DateTimeInterface $dateLimitRegister): static
    {
        $this->dateLimitRegister = $dateLimitRegister;

        return $this;
    }

    public function getRegisterMax(): ?int
    {
        return $this->registerMax;
    }

    public function setRegisterMax(int $registerMax): static
    {
        $this->registerMax = $registerMax;

        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function setInformation(?string $information): static
    {
        $this->information = $information;

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

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setStatut(?Statut $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): static
    {
        $this->place = $place;

        return $this;
    }

    public function getPromoter(): ?Users
    {
        return $this->promoter;
    }

    public function setPromoter(?Users $promoter): static
    {
        $this->promoter = $promoter;

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
            $usersOutside->addOutside($this);
        }

        return $this;
    }

    public function removeUsersOutside(UsersOutside $usersOutside): static
    {
        if ($this->usersOutsides->removeElement($usersOutside)) {
            $usersOutside->removeOutside($this);
        }

        return $this;
    }
}
