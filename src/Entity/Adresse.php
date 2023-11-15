<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'std.adresse')]
class Adresse
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private ?int $adresseId = null;

    #[ORM\Column(nullable: true)]
    private ?string $strasse = null;

    #[ORM\Column(nullable: true)]
    private ?string $plz = null;

    #[ORM\Column(nullable: true)]
    private ?string $ort = null;

    #[ORM\Column(nullable: true)]
    private ?string $bundesland;

    #[ORM\OneToMany(mappedBy: 'adressen', targetEntity: KundeAdresse::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(name: 'adresse_id', referencedColumnName: 'adresse_id')]
    private Collection $details;

    public function getStrasse(): ?string
    {
        return $this->strasse;
    }

    public function setStrasse(?string $strasse): self
    {
        $this->strasse = $strasse;

        return $this;
    }

    public function getPlz(): ?string
    {
        return $this->plz;
    }

    public function setPlz(?string $plz): self
    {
        $this->plz = $plz;

        return $this;
    }

    public function getOrt(): ?string
    {
        return $this->ort;
    }

    public function setOrt(?string $ort): self
    {
        $this->ort = $ort;

        return $this;
    }

    public function getBundesland(): ?string
    {
        return $this->bundesland;
    }

    public function setBundesland(?string $bundesland): self
    {
        $this->bundesland = $bundesland;

        return $this;
    }

    public function getAdresseId(): ?int
    {
        return $this->adresseId;
    }

    public function setAdresseId(?int $adresseId): self
    {
        $this->adresseId = $adresseId;

        return $this;
    }

    public function getId(): int
    {
        return $this->getAdresseId();
    }

    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function setDetails(Collection $details): self
    {
        $this->details = $details;

        return $this;
    }
}

