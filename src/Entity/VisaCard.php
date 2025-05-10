<?php

namespace App\Entity;

use App\Repository\VisaCardRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisaCardRepository::class)]
class VisaCard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $identifiant = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $alias = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $immatriculation = null;

    #[ORM\Column]
    private ?bool $actived = null;

    #[ORM\Column]
    private ?bool $attribution = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DateAttrib = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateActivate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $archivingDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comment = null;

    #[ORM\Column(nullable: true)]
    private ?bool $pret = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): static
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): static
    {
        $this->alias = $alias;

        return $this;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(?string $immatriculation): static
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function isactived(): ?bool
    {
        return $this->actived;
    }

    public function setActived(bool $actived): static
    {
        $this->actived = $actived;

        return $this;
    }

    public function getAttribution(): ?bool
    {
        return $this->attribution;
    }

    public function setAttribution(bool $attribution): static
    {
        $this->attribution = $attribution;

        return $this;
    }

    public function getDateAttrib(): ?\DateTimeInterface
    {
        return $this->DateAttrib;
    }

    public function setDateAttrib(?\DateTimeInterface $DateAttrib): static
    {
        $this->DateAttrib = $DateAttrib;

        return $this;
    }

    public function getDateActivate(): ?\DateTimeInterface
    {
        return $this->dateActivate;
    }

    public function setDateActivate(?\DateTimeInterface $dateActivate): static
    {
        $this->dateActivate = $dateActivate;

        return $this;
    }

    public function getArchivingDate(): ?\DateTimeInterface
    {
        return $this->archivingDate;
    }

    public function setArchivingDate(?\DateTimeInterface $archivingDate): static
    {
        $this->archivingDate = $archivingDate;

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
