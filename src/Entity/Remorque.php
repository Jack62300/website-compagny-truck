<?php

namespace App\Entity;

use App\Repository\RemorqueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RemorqueRepository::class)]
class Remorque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $compagnie = null;

    #[ORM\Column(length: 255)]
    private ?string $plate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEnter = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tempsPasser = null;

    #[ORM\Column(nullable: true)]
    private ?int $calle = null;

    #[ORM\Column(length: 255)]
    private ?string $agent = null;

    #[ORM\Column(nullable: true)]
    private ?bool $status = null;

    #[ORM\Column]
    private ?bool $isFridge = null;

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

    public function getDateEnter(): ?\DateTimeInterface
    {
        return $this->dateEnter;
    }

    public function setDateEnter(\DateTimeInterface $dateEnter): static
    {
        $this->dateEnter = $dateEnter;

        return $this;
    }

    public function getTempsPasser(): ?string
    {
        return $this->tempsPasser;
    }

    public function setTempsPasser(?string $tempsPasser): static
    {
        $this->tempsPasser = $tempsPasser;

        return $this;
    }

    public function getCalle(): ?int
    {
        return $this->calle;
    }

    public function setCalle(?int $calle): static
    {
        $this->calle = $calle;

        return $this;
    }

    public function getAgent(): ?string
    {
        return $this->agent;
    }

    public function setAgent(string $agent): static
    {
        $this->agent = $agent;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function isIsFridge(): ?bool
    {
        return $this->isFridge;
    }

    public function setIsFridge(bool $isFridge): static
    {
        $this->isFridge = $isFridge;

        return $this;
    }
}
