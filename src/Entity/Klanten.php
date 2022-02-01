<?php

namespace App\Entity;

use App\Repository\KlantenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KlantenRepository::class)]
class Klanten
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Naam;

    #[ORM\Column(type: 'integer')]
    private $Telefoon;

    #[ORM\Column(type: 'string', length: 255)]
    private $Email;

    #[ORM\OneToMany(mappedBy: 'Klant_Id', targetEntity: Reserveringen::class)]
    private $reservering;

    public function __construct()
    {
        $this->reservering = new ArrayCollection();
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

    public function getTelefoon(): ?int
    {
        return $this->Telefoon;
    }

    public function setTelefoon(int $Telefoon): self
    {
        $this->Telefoon = $Telefoon;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    /**
     * @return Collection|Reserveringen[]
     */
    public function getReservering(): Collection
    {
        return $this->reservering;
    }

    public function addReservering(Reserveringen $reservering): self
    {
        if (!$this->reservering->contains($reservering)) {
            $this->reservering[] = $reservering;
            $reservering->setKlantId($this);
        }

        return $this;
    }

    public function removeReservering(Reserveringen $reservering): self
    {
        if ($this->reservering->removeElement($reservering)) {
            // set the owning side to null (unless already changed)
            if ($reservering->getKlantId() === $this) {
                $reservering->setKlantId(null);
            }
        }

        return $this;
    }
}
