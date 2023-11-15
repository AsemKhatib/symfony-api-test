<?php

namespace App\Entity\Security;

use App\Entity\Kunde;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints;

#[ORM\Entity]
#[ORM\Table(name: 'sec.user')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private int $id;

    #[ORM\Column(length: 200, nullable: true)]
    #[Constraints\NotBlank]
    #[Constraints\Email]
    private ?string $email = null;

    #[ORM\Column(length: 60, nullable: true)]
    #[Constraints\NotBlank]
    private ?string $passwd = null;

    #[ORM\Column(nullable: true)]
    private ?int $aktiv = null;

    #[ORM\Column(nullable: true)]
    private ?string $lastLogin = null;

    #[ORM\OneToOne(targetEntity: Kunde::class)]
    #[ORM\JoinColumn(name: 'kundenid', referencedColumnName: 'id', nullable: true)]
    private Kunde $kunde;

    public function getId(): int
    {
        return $this->id;
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

    public function getPasswd(): ?string
    {
        return $this->passwd;
    }

    public function setPasswd(?string $passwd): self
    {
        $this->passwd = $passwd;

        return $this;
    }

    public function getAktiv(): ?int
    {
        return $this->aktiv;
    }

    public function setAktiv(?int $aktiv): self
    {
        $this->aktiv = $aktiv;

        return $this;
    }

    public function getLastLogin(): ?string
    {
        return $this->lastLogin;
    }

    public function setLastLogin(?DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    public function getKunde(): Kunde
    {
        return $this->kunde;
    }

    public function setKunde(?Kunde $kunde): self
    {
        $this->kunde = $kunde;

        return $this;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function getPassword(): ?string
    {
        return $this->getPasswd();
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->getEmail();
    }

    public function eraseCredentials()
    {
        // Implement if needed
    }

    public function getUserIdentifier(): string
    {
        return $this->getEmail();
    }
}

