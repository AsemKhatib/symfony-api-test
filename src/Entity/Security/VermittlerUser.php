<?php

// src/Entity/VermittlerUser.php

namespace App\Entity\Security;

use App\Entity\Vermittler;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints;
use App\Validator\Constraints AS CustomConstraints;

#[ORM\Entity]
#[ORM\Table(name: 'sec.vermittler_user')]
class VermittlerUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private int $id;

    #[Constraints\Email]
    #[ORM\Column(length: 200, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 60, nullable: true)]
    #[CustomConstraints\PasswordConstraint]
    private ?string $passwd = null;

    #[ORM\OneToOne(targetEntity: Vermittler::class)]
    #[ORM\JoinColumn(name: 'vermittler_id', referencedColumnName: 'id', nullable: false)]
    private Vermittler $vermittler;

    #[ORM\Column(nullable: true)]
    private ?int $aktiv = null;

    #[ORM\Column(nullable: true)]
    private ?string $lastLogin = null;


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

    public function getVermittler(): Vermittler
    {
        return $this->vermittler;
    }

    public function setVermittler(Vermittler $vermittler): self
    {
        $this->vermittler = $vermittler;

        return $this;
    }

    public function getAktiv() : ?int
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

    public function getRoles(): array
    {
        // Return an array of roles if applicable
        return [];
    }

    public function getPassword(): ?string
    {
        return $this->getPasswd();
    }

    public function getSalt()
    {
        // Return a salt if applicable
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
        return $this->getId();
    }
}

