<?php

namespace App\Entity;

use App\Entity\RegistreImage;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RegistreRepository;
use Symfony\UX\Turbo\Attribute\Broadcast;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: RegistreRepository::class)]
#[Broadcast]
class Registre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intituler = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: false)]
    private ?\DateTimeInterface $createdAt = null;





    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(length: 255)]
    private ?string $agent = null;
    

    #[ORM\OneToMany(mappedBy: 'registre', targetEntity: RegistreImage::class, cascade: ['persist', 'remove'])]
    private Collection $images;



    #[ORM\ManyToMany(targetEntity: RegistreStatus::class, inversedBy: 'registres')]
    private Collection $status;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: RegistreComment::class)]
    private Collection $registreComments;

    #[ORM\Column(length: 255)]
    private ?string $categorie = null;


    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->status = new ArrayCollection();
        $this->registreComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntituler(): ?string
    {
        return $this->intituler;
    }

    public function setIntituler(string $intituler): static
    {
        $this->intituler = $intituler;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

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

     /**
     * @return Collection<int, RegistreImage>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(RegistreImage $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setRegistre($this);
        }

        return $this;
    }

    public function removeImage(RegistreImage $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getRegistre() === $this) {
                $image->setRegistre(null);
            }
        }

        return $this;
    }



    /**
     * @return Collection<int, RegistreStatus>
     */
    public function getStatus(): Collection
    {
        return $this->status;
    }

    public function addStatus(RegistreStatus $status): static
    {
        if (!$this->status->contains($status)) {
            $this->status->add($status);
        }

        return $this;
    }

    public function removeStatus(RegistreStatus $status): static
    {
        $this->status->removeElement($status);

        return $this;
    }

    /**
     * @return Collection<int, RegistreComment>
     */
    public function getRegistreComments(): Collection
    {
        return $this->registreComments;
    }

    public function addRegistreComment(RegistreComment $registreComment): static
    {
        if (!$this->registreComments->contains($registreComment)) {
            $this->registreComments->add($registreComment);
            $registreComment->setParent($this);
        }

        return $this;
    }

    public function removeRegistreComment(RegistreComment $registreComment): static
    {
        if ($this->registreComments->removeElement($registreComment)) {
            // set the owning side to null (unless already changed)
            if ($registreComment->getParent() === $this) {
                $registreComment->setParent(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }



}
