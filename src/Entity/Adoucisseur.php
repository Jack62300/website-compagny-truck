<?php

namespace App\Entity;

use App\Repository\AdoucisseurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdoucisseurRepository::class)]
class Adoucisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $sacRestant = null;

    #[ORM\Column]
    private ?int $sacUse = null;

    #[ORM\Column(length: 255)]
    private ?string $agent = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSacRestant(): ?int
    {
        return $this->sacRestant;
    }

    public function setSacRestant(int $sacRestant): static
    {
        $this->sacRestant = $sacRestant;

        return $this;
    }

    public function getSacUse(): ?int
    {
        return $this->sacUse;
    }

    public function setSacUse(int $sacUse): static
    {
        $this->sacUse = $sacUse;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }
}
