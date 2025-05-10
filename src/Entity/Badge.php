<?php

namespace App\Entity;

use App\Repository\BadgeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BadgeRepository::class)]
class Badge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $badgeNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $serialNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $Identifiant1 = null;

    #[ORM\Column(length: 255)]
    private ?string $Identifiant2 = null;

    #[ORM\Column(length: 255)]
    private ?string $Identifiant3 = null;

    #[ORM\Column(length: 255)]
    private ?string $immatriculation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $service = null;

    #[ORM\Column]
    private ?bool $attribution = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $situation = null;

    #[ORM\Column(nullable: true)]
    private ?bool $pret = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBadgeNumber(): ?string
    {
        return $this->badgeNumber;
    }

    public function setBadgeNumber(string $badgeNumber): static
    {
        $this->badgeNumber = $badgeNumber;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(string $serialNumber): static
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    public function getIdentifiant1(): ?string
    {
        return $this->Identifiant1;
    }

    public function setIdentifiant1(string $Identifiant1): static
    {
        $this->Identifiant1 = $Identifiant1;

        return $this;
    }

    public function getIdentifiant2(): ?string
    {
        return $this->Identifiant2;
    }

    public function setIdentifiant2(string $Identifiant2): static
    {
        $this->Identifiant2 = $Identifiant2;

        return $this;
    }

    public function getIdentifiant3(): ?string
    {
        return $this->Identifiant3;
    }

    public function setIdentifiant3(string $Identifiant3): static
    {
        $this->Identifiant3 = $Identifiant3;

        return $this;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): static
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(?string $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function isAttribution(): ?bool
    {
        return $this->attribution;
    }

    public function setAttribution(bool $attribution): static
    {
        $this->attribution = $attribution;

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

    public function isPret(): ?bool
    {
        return $this->pret;
    }

    public function setPret(?bool $pret): static
    {
        $this->pret = $pret;

        return $this;
    }
}
