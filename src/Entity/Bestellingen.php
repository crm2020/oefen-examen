<?php

namespace App\Entity;

use App\Repository\BestellingenRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BestellingenRepository::class)]
class Bestellingen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $Aantal;

    #[ORM\Column(type: 'string', length: 255)]
    private $Gereserveerd;

    #[ORM\ManyToOne(targetEntity: Reserveringen::class, inversedBy: 'Bestellingen')]
    private $Reservering_Id;

    #[ORM\ManyToOne(targetEntity: Menuitems::class, inversedBy: 'Bestellingen')]
    private $Menuitem_Id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAantal(): ?int
    {
        return $this->Aantal;
    }

    public function setAantal(int $Aantal): self
    {
        $this->Aantal = $Aantal;

        return $this;
    }

    public function getGereserveerd(): ?string
    {
        return $this->Gereserveerd;
    }

    public function setGereserveerd(string $Gereserveerd): self
    {
        $this->Gereserveerd = $Gereserveerd;

        return $this;
    }

    public function getReserveringId(): ?Reserveringen
    {
        return $this->Reservering_Id;
    }

    public function setReserveringId(?Reserveringen $Reservering_Id): self
    {
        $this->Reservering_Id = $Reservering_Id;

        return $this;
    }

    public function getMenuitemId(): ?Menuitems
    {
        return $this->Menuitem_Id;
    }

    public function setMenuitemId(?Menuitems $Menuitem_Id): self
    {
        $this->Menuitem_Id = $Menuitem_Id;

        return $this;
    }
}
