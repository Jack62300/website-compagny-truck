<?php

namespace App\Entity;

use App\Repository\RegistreStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegistreStatusRepository::class)]
class RegistreStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $icon = null;

    #[ORM\ManyToMany(targetEntity: Registre::class, mappedBy: 'status')]
    private Collection $registres;

    public function __construct()
    {
        $this->registres = new ArrayCollection();
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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return Collection<int, Registre>
     */
    public function getRegistres(): Collection
    {
        return $this->registres;
    }

    public function addRegistre(Registre $registre): static
    {
        if (!$this->registres->contains($registre)) {
            $this->registres->add($registre);
            $registre->addStatus($this);
        }

        return $this;
    }

    public function removeRegistre(Registre $registre): static
    {
        if ($this->registres->removeElement($registre)) {
            $registre->removeStatus($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
