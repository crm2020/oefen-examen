<?php

namespace App\Entity;

use App\Repository\GerechtSoortenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GerechtSoortenRepository::class)]
class GerechtSoorten
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Naam;

    #[ORM\OneToMany(mappedBy: 'Gerechtsoort_Id', targetEntity: Menuitems::class)]
    private $menuitems;

    #[ORM\ManyToOne(targetEntity: GerechtCategorie::class, inversedBy: 'GerechtSoorten')]
    #[ORM\JoinColumn(nullable: false)]
    private $GerechtCategorie;

    public function __construct()
    {
        $this->menuitems = new ArrayCollection();
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
     * @return Collection|Menuitems[]
     */
    public function getMenuitems(): Collection
    {
        return $this->menuitems;
    }

    public function addMenuitem(Menuitems $menuitem): self
    {
        if (!$this->menuitems->contains($menuitem)) {
            $this->menuitems[] = $menuitem;
            $menuitem->setGerechtsoortId($this);
        }

        return $this;
    }

    public function removeMenuitem(Menuitems $menuitem): self
    {
        if ($this->menuitems->removeElement($menuitem)) {
            // set the owning side to null (unless already changed)
            if ($menuitem->getGerechtsoortId() === $this) {
                $menuitem->setGerechtsoortId(null);
            }
        }

        return $this;
    }

    public function getGerechtCategorie(): ?GerechtCategorie
    {
        return $this->GerechtCategorie;
    }

    public function setGerechtCategorie(?GerechtCategorie $GerechtCategorie): self
    {
        $this->GerechtCategorie = $GerechtCategorie;

        return $this;
    }
}
