<?php

namespace App\Entity;

use App\Repository\MenuItemsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuItemsRepository::class)]
class MenuItems
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Naam;

    #[ORM\OneToMany(mappedBy: 'Menuitem_Id', targetEntity: Bestellingen::class)]
    private $Bestellingen;

    #[ORM\ManyToOne(targetEntity: Gerechtsoorten::class, inversedBy: 'menuitems')]
    #[ORM\JoinColumn(nullable: false)]
    private $Gerechtsoort_Id;

    #[ORM\Column(type: 'float')]
    private $prijs;

    public function __construct()
    {
        $this->Bestellingen = new ArrayCollection();
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
     * @return Collection|Bestellingen[]
     */
    public function getBestellingen(): Collection
    {
        return $this->Bestellingen;
    }

    public function addBestellingen(Bestellingen $bestellingen): self
    {
        if (!$this->Bestellingen->contains($bestellingen)) {
            $this->Bestellingen[] = $bestellingen;
            $bestellingen->setMenuitemId($this);
        }

        return $this;
    }

    public function removeBestellingen(Bestellingen $bestellingen): self
    {
        if ($this->Bestellingen->removeElement($bestellingen)) {
            // set the owning side to null (unless already changed)
            if ($bestellingen->getMenuitemId() === $this) {
                $bestellingen->setMenuitemId(null);
            }
        }

        return $this;
    }

    public function getGerechtsoortId(): ?Gerechtsoorten
    {
        return $this->Gerechtsoort_Id;
    }

    public function setGerechtsoortId(?Gerechtsoorten $Gerechtsoort_Id): self
    {
        $this->Gerechtsoort_Id = $Gerechtsoort_Id;

        return $this;
    }

    public function getPrijs(): ?float
    {
        return $this->prijs;
    }

    public function setPrijs(float $prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }
}
