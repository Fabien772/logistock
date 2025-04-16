<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;





#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\Column(length: 255)]
    private ?string $immat = null;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'vehicle', cascade: ['remove'])]
    private Collection $reservations;

    #[ORM\Column(length: 255)]
    private ?string $modele = null;

   

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $attribution = null;

    

    #[ORM\Column]
    private ?bool $equipementPolice = null;

    #[ORM\Column]
    private ?bool $pret = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $situation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comment = null;

    

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numeroPlace = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateCT = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateAcquisition = null;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getImmat(): ?string
    {
        return $this->immat;
    }

    public function setImmat(string $immat): static
    {
        $this->immat = $immat;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setVehicle($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getVehicle() === $this) {
                $reservation->setVehicle(null);
            }
        }

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

   

    public function getAttribution(): ?string
    {
        return $this->attribution;
    }

    public function setAttribution(?string $attribution): static
    {
        $this->attribution = $attribution;

        return $this;
    }

    

    public function isEquipementPolice(): ?bool
    {
        return $this->equipementPolice;
    }

    public function setEquipementPolice(bool $equipementPolice): static
    {
        $this->equipementPolice = $equipementPolice;

        return $this;
    }

    public function isPret(): ?bool
    {
        return $this->pret;
    }

    public function setPret(bool $pret): static
    {
        $this->pret = $pret;

        return $this;
    }

    public function getSituation(): ?string
    {
        return $this->situation;
    }

    public function setSituation(?string $situation): static
    {
        $this->situation = $situation;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

   

    public function getNumeroPlace(): ?string
    {
        return $this->numeroPlace;
    }

    public function setNumeroPlace(?string $numeroPlace): static
    {
        $this->numeroPlace = $numeroPlace;

        return $this;
    }

    public function getDateCT(): ?\DateTimeInterface
    {
        return $this->dateCT;
    }


        
    

    public function setDateCT(?\DateTimeInterface $dateCT): static
    {
        $this->dateCT = $dateCT;

        return $this;
    }

    public function getDateAcquisition(): ?\DateTimeInterface
    {
        return $this->dateAcquisition;
    }

    public function setDateAcquisition(?\DateTimeInterface $dateAcquisition): static
    {
        $this->dateAcquisition = $dateAcquisition;

        return $this;
    }
}
