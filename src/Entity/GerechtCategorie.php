<?php

namespace App\Entity;

use App\Repository\GerechtCategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GerechtCategorieRepository::class)]
class GerechtCategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Naam;

    #[ORM\OneToMany(mappedBy: 'GerechtCategorie', targetEntity: Gerechtsoorten::class)]
    private $Gerechtsoorten;

    public function __construct()
    {
        $this->Gerechtsoorten = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->Naam;
    }

    public function setNaam(string $Naam): self
    {
        $this->Naam = $Naam;

        return $this;
    }

    /**
     * @return Collection|Gerechtsoorten[]
     */
    public function getGerechtsoorten(): Collection
    {
        return $this->Gerechtsoorten;
    }

    public function addGerechtsoorten(Gerechtsoorten $gerechtsoorten): self
    {
        if (!$this->Gerechtsoorten->contains($gerechtsoorten)) {
            $this->Gerechtsoorten[] = $gerechtsoorten;
            $gerechtsoorten->setGerechtCategorie($this);
        }

        return $this;
    }

    public function removeGerechtsoorten(Gerechtsoorten $gerechtsoorten): self
    {
        if ($this->Gerechtsoorten->removeElement($gerechtsoorten)) {
            // set the owning side to null (unless already changed)
            if ($gerechtsoorten->getGerechtCategorie() === $this) {
                $gerechtsoorten->setGerechtCategorie(null);
            }
        }

        return $this;
    }
}
