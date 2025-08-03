<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $compagnie = null;

    #[ORM\Column(length: 255)]
    private ?string $plate = null;

    #[ORM\Column]
    private ?bool $frigo = null;

    #[ORM\Column(length: 255)]
    private ?string $maxHeure = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $heureArrival = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $idTransaction = null;

    #[ORM\Column(nullable: true)]
    private ?int $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompagnie(): ?string
    {
        return $this->compagnie;
    }

    public function setCompagnie(string $compagnie): static
    {
        $this->compagnie = $compagnie;

        return $this;
    }

    public function getPlate(): ?string
    {
        return $this->plate;
    }

    public function setPlate(string $plate): static
    {
        $this->plate = $plate;

        return $this;
    }

    public function isFrigo(): ?bool
    {
        return $this->frigo;
    }

    public function setFrigo(bool $frigo): static
    {
        $this->frigo = $frigo;

        return $this;
    }

    public function getMaxHeure(): ?string
    {
        return $this->maxHeure;
    }

    public function setMaxHeure(string $maxHeure): static
    {
        $this->maxHeure = $maxHeure;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getHeureArrival(): ?string
    {
        return $this->heureArrival;
    }

    public function setHeureArrival(string $heureArrival): static
    {
        $this->heureArrival = $heureArrival;

        return $this;
    }

    public function getIdTransaction(): ?string
    {
        return $this->idTransaction;
    }

    public function setIdTransaction(?string $idTransaction): static
    {
        $this->idTransaction = $idTransaction;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): static
    {
        $this->status = $status;

        return $this;
    }
}
