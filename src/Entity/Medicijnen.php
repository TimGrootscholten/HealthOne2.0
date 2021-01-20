<?php

namespace App\Entity;

use App\Repository\MedicijnenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MedicijnenRepository::class)
 */
class Medicijnen
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $naam;

    /**
     * @ORM\Column(type="text")
     */
    private $werking;

    /**
     * @ORM\Column(type="text")
     */
    private $bijwerking;

    /**
     * @ORM\Column(type="float")
     */
    private $kosten;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verzekerd;

    /**
     * @ORM\OneToMany(targetEntity=Recepten::class, mappedBy="medicijnen")
     */
    private $receptens;

    public function __construct()
    {
        $this->receptens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getWerking(): ?string
    {
        return $this->werking;
    }

    public function setWerking(string $werking): self
    {
        $this->werking = $werking;

        return $this;
    }

    public function getBijwerking(): ?string
    {
        return $this->bijwerking;
    }

    public function setBijwerking(string $bijwerking): self
    {
        $this->bijwerking = $bijwerking;

        return $this;
    }

    public function getKosten(): ?float
    {
        return $this->kosten;
    }

    public function setKosten(float $kosten): self
    {
        $this->kosten = $kosten;

        return $this;
    }

    public function getVerzekerd(): ?bool
    {
        return $this->verzekerd;
    }

    public function setVerzekerd(bool $verzekerd): self
    {
        $this->verzekerd = $verzekerd;

        return $this;
    }

    /**
     * @return Collection|Recepten[]
     */
    public function getReceptens(): Collection
    {
        return $this->receptens;
    }

    public function addRecepten(Recepten $recepten): self
    {
        if (!$this->receptens->contains($recepten)) {
            $this->receptens[] = $recepten;
            $recepten->setMedicijnen($this);
        }

        return $this;
    }

    public function removeRecepten(Recepten $recepten): self
    {
        if ($this->receptens->removeElement($recepten)) {
            // set the owning side to null (unless already changed)
            if ($recepten->getMedicijnen() === $this) {
                $recepten->setMedicijnen(null);
            }
        }

        return $this;
    }
}