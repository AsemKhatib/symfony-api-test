<?php 

// src/Entity/KundeAdresse.php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'std.kunde_adresse')]
class KundeAdresse
{
    #[ORM\Id]
    #[ORM\Column(name: 'adresse_id')]
    private int $adresseId;

    #[ORM\Id]
    #[ORM\Column(name: 'kunde_id')]
    private string $kundeId;

    #[ORM\ManyToOne(targetEntity: Kunde::class)]
    private Kunde $kunde;

    #[ORM\Column(nullable: false, options: ['KundeAdressedefault' => false])]
    private bool $geschaeftlich = false;

    #[ORM\Column(nullable: true)]
    private ?bool $rechnungsadresse = null;

    #[ORM\Column(nullable: false, options: ['default' => false])]
    private bool $geloescht = false;

    #[ORM\ManyToOne(targetEntity: Adresse::class, inversedBy: 'details')]
    #[ORM\JoinColumn(name: 'adresse_id', referencedColumnName: 'adresse_id')]
    private $adressen;

    public function isGeschaeftlich(): bool
    {
        return $this->geschaeftlich;
    }

    public function setGeschaeftlich(bool $geschaeftlich): self
    {
        $this->geschaeftlich = $geschaeftlich;

        return $this;
    }

    public function isRechnungsadresse(): ?bool
    {
        return $this->rechnungsadresse;
    }

    public function setRechnungsadresse(?bool $rechnungsadresse): self
    {
        $this->rechnungsadresse = $rechnungsadresse;

        return $this;
    }

    public function isGeloescht(): bool
    {
        return $this->geloescht;
    }

    public function setGeloescht(bool $geloescht): self
    {
        $this->geloescht = $geloescht;

        return $this;
    }

    public function getKundeId(): string
    {
        return $this->kundeId;
    }

    public function setKundeId(string $kundeId): self
    {
        $this->kundeId = $kundeId;

        return $this;
    }

    public function getAdresseId(): int
    {
        return $this->adresseId;
    }

    public function setAdresseId(int $adresseId): self
    {
        $this->adresseId = $adresseId;

        return $this;
    }

    public function getKunde(): Kunde
    {
        return $this->kunde;
    }

    public function setKunde(Kunde $kunde): self
    {
        $this->kunde = $kunde;

        return $this;
    }

    public function getAdressen(): Collection
    {
        return $this->adressen;
    }

    public function setAdressen($adressen): self
    {
        $this->adressen = $adressen;

        return $this;
    }
}

