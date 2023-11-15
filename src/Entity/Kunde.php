<?php

// src/Entity/StdKunden.php

namespace App\Entity;

use App\Doctrine\Generator\KundeCustomGenerator;
use App\Entity\Security\User;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints;

#[ORM\Entity]
#[ORM\Table(name: 'std.tbl_kunden')]
class Kunde
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: KundeCustomGenerator::class)]
    #[ORM\Column(length: 36, unique: true, nullable: false)]
    private string $id;

    #[Constraints\NotBlank]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[Constraints\NotBlank]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vorname = null;

    #[Constraints\NotBlank]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firma = null;

    #[Constraints\NotBlank]
    #[ORM\Column(nullable: true)]
    private ?string $geburtsdatum = null;

    #[ORM\Column(nullable: true, options: ['default' => 0])]
    private ?int $geloescht = 0;

    #[Constraints\Choice(choices: ['männlich', 'weiblich', 'divers'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $geschlecht;

    #[Constraints\Email]
    #[ORM\Column(nullable: true)]
    private ?string $email = null;

    #[ORM\Column(name: 'vermittler_id', nullable: true)]
    private ?int $vermittlerId = null;

    #[ORM\OneToOne(mappedBy: 'kunde', targetEntity: User::class)]
    private User $user;

//    #[ORM\OneToMany(mappedBy: 'kunde', targetEntity: KundeAdresse::class)]
//    private Collection $adressen;


    #[ORM\ManyToMany(targetEntity: Adresse::class, inversedBy: 'kunden')]
    #[ORM\JoinTable(name: 'std.kunde_adresse')]
    #[ORM\JoinColumn(name: 'kunde_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'adresse_id', referencedColumnName: 'adresse_id')]
    private Collection $adressen;

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getVorname()
    {
        return $this->vorname;
    }

    public function setVorname(?string $vorname): self
    {
        $this->vorname = $vorname;

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

    public function getGeburtsdatum(): ?string
    {
        return $this->geburtsdatum;
    }

    public function setGeburtsdatum(?DateTimeInterface $geburtsdatum): self
    {
        $this->geburtsdatum = $geburtsdatum;

        return $this;
    }

    public function getGeloescht(): ?int
    {
        return $this->geloescht;
    }

    public function setGeloescht(?int $geloescht): self
    {
        $this->geloescht = $geloescht;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setVermittlerId(int $ermittlerId): self
    {
        $this->vermittlerId = $ermittlerId;

        return $this;
    }
    public function getVermittlerId(): int
    {
        return $this->vermittlerId;
    }

    public function getGeschlecht(): ?string
    {
        return $this->geschlecht;
    }

    public function setGeschlecht(?string $geschlecht): self
    {
        $this->geschlecht = $geschlecht;

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

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}

