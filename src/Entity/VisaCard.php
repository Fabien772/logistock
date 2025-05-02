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
    private ?bool $desactived = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DateAttrib = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $activatedOn = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $archivingDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comment = null;

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

    public function isDesactived(): ?bool
    {
        return $this->desactived;
    }

    public function setDesactived(bool $desactived): static
    {
        $this->desactived = $desactived;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

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

    public function getActivatedOn(): ?\DateTimeInterface
    {
        return $this->activatedOn;
    }

    public function setActivatedOn(?\DateTimeInterface $activatedOn): static
    {
        $this->activatedOn = $activatedOn;

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
}
