<?php

namespace App\Entity;

use App\Entity\Security\VermittlerUser;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'std.vermittler')]
class Vermittler
{
    #[ORM\Id]
    #[ORM\Column(unique: true)]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(length: 36, unique: true, nullable: false)]
    private string $nummer;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vorname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nachname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firma = null;

    #[ORM\Column(nullable: false, options: ['default' => false])]
    private bool $geloescht = false;

    #[ORM\OneToOne(mappedBy: 'vermittler', targetEntity: VermittlerUser::class)]
    private VermittlerUser $vermittlerUser;

    public function getId(): int
    {
        return $this->id;
    }

    public function getNummer(): string
    {
        return $this->nummer;
    }

    public function setNummer(string $nummer): self
    {
        $this->nummer = $nummer;

        return $this;
    }

    public function getVorname(): ?string
    {
        return $this->vorname;
    }

    public function setVorname(?string $vorname): self
    {
        $this->vorname = $vorname;

        return $this;
    }

    public function getNachname(): ?string
    {
        return $this->nachname;
    }

    public function setNachname(?string $nachname): self
    {
        $this->nachname = $nachname;

        return $this;
    }

    public function getFirma(): ?string
    {
        return $this->firma;
    }

    public function setFirma(?string $firma): self
    {
        $this->firma = $firma;

        return $this;
    }

    public function getGeloescht() : bool
    {
        return $this->geloescht;
    }


    public function setGeloescht(bool $geloescht) : self
    {
        $this->geloescht = $geloescht;

        return $this;
    }

    public function getVermittlerUser(): VermittlerUser
    {
        return $this->vermittlerUser;
    }

    public function setVermittlerUser(VermittlerUser $vermittlerUser): self
    {
        $this->vermittlerUser = $vermittlerUser;

        return $this;
    }
}
