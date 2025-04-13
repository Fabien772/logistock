<?php

namespace App\Entity;

use App\Repository\SuppliesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuppliesRepository::class)]
class Supplies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Reference = null;

    #[ORM\Column(length: 255)]
    private ?string $TypeSupplies = null;

    #[ORM\Column(length: 255)]
    private ?string $Marque = null;

    #[ORM\Column(nullable: true)]
    private ?int $QuantityCommand = null;

    #[ORM\Column(nullable: true)]
    private ?int $QuantityTotal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->Reference;
    }

    public function setReference(string $Reference): static
    {
        $this->Reference = $Reference;

        return $this;
    }

    public function getTypeSupplies(): ?string
    {
        return $this->TypeSupplies;
    }

    public function setTypeSupplies(string $TypeSupplies): static
    {
        $this->TypeSupplies = $TypeSupplies;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->Marque;
    }

    public function setMarque(string $Marque): static
    {
        $this->Marque = $Marque;

        return $this;
    }

    public function getQuantityCommand(): ?int
    {
        return $this->QuantityCommand;
    }

    public function setQuantityCommand(?int $QuantityCommand): static
    {
        $this->QuantityCommand = $QuantityCommand;

        return $this;
    }

    public function getQuantityTotal(): ?int
    {
        return $this->QuantityTotal;
    }

    public function setQuantityTotal(?int $QuantityTotal): static
    {
        $this->QuantityTotal = $QuantityTotal;

        return $this;
    }
}
