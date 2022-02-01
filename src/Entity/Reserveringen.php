<?php

namespace App\Entity;

use App\Repository\ReserveringenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReserveringenRepository::class)]
class Reserveringen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $Tafel;

    #[ORM\Column(type: 'date')]
    private $Datum;

    #[ORM\Column(type: 'time')]
    private $Tijd;

    #[ORM\Column(type: 'integer')]
    private $Aantal;

    #[ORM\Column(type: 'string', length: 255)]
    private $Status;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Allergien;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Opmerkingen;

    #[ORM\Column(type: 'date')]
    private $DatumToegevoegd;

    #[ORM\ManyToOne(targetEntity: Klanten::class, inversedBy: 'reservering')]
    #[ORM\JoinColumn(nullable: false)]
    private $Klant_Id;

    #[ORM\OneToMany(mappedBy: 'Reservering_Id', targetEntity: Bestellingen::class)]
    private $Bestellingen;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $AantalKinderen;

    public function __construct()
    {
        $this->Bestellingen = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTafel(): ?int
    {
        return $this->Tafel;
    }

    public function setTafel(int $Tafel): self
    {
        $this->Tafel = $Tafel;

        return $this;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->Datum;
    }

    public function setDatum(\DateTimeInterface $Datum): self
    {
        $this->Datum = $Datum;

        return $this;
    }

    public function getTijd(): ?\DateTimeInterface
    {
        return $this->Tijd;
    }

    public function setTijd(\DateTimeInterface $Tijd): self
    {
        $this->Tijd = $Tijd;

        return $this;
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

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getAllergien(): ?string
    {
        return $this->Allergien;
    }

    public function setAllergien(?string $Allergien): self
    {
        $this->Allergien = $Allergien;

        return $this;
    }

    public function getOpmerkingen(): ?string
    {
        return $this->Opmerkingen;
    }

    public function setOpmerkingen(?string $Opmerkingen): self
    {
        $this->Opmerkingen = $Opmerkingen;

        return $this;
    }

    public function getDatumToegevoegd(): ?\DateTimeInterface
    {
        return $this->DatumToegevoegd;
    }

    public function setDatumToegevoegd(\DateTimeInterface $DatumToegevoegd): self
    {
        $this->DatumToegevoegd = $DatumToegevoegd;

        return $this;
    }

    public function getKlantId(): ?Klanten
    {
        return $this->Klant_Id;
    }

    public function setKlantId(?Klanten $Klant_Id): self
    {
        $this->Klant_Id = $Klant_Id;

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
            $bestellingen->setReserveringId($this);
        }

        return $this;
    }

    public function removeBestellingen(Bestellingen $bestellingen): self
    {
        if ($this->Bestellingen->removeElement($bestellingen)) {
            // set the owning side to null (unless already changed)
            if ($bestellingen->getReserveringId() === $this) {
                $bestellingen->setReserveringId(null);
            }
        }

        return $this;
    }

    public function getAantalKinderen(): ?int
    {
        return $this->AantalKinderen;
    }

    public function setAantalKinderen(?int $AantalKinderen): self
    {
        $this->AantalKinderen = $AantalKinderen;

        return $this;
    }
}
