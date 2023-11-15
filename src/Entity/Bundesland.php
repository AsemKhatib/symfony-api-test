<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'public.bundesland')]
class Bundesland
{
    #[ORM\Id]
    #[ORM\Column(length: 2, nullable: false)]
    private ?string $kuerzel;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $name;

    #[ORM\OneToMany(mappedBy: 'bundesland', targetEntity: Adresse::class)]
    private ?Collection $adressen;

    public function getKuerzel(): string
    {
        return $this->kuerzel;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAdressen(): Collection
    {
        return $this->adressen;
    }

    public function addAdresse(Adresse $adresse): self
    {
        if (!$this->adressen->contains($adresse)) {
            $this->adressen[] = $adresse;
            $adresse->setBundesland($this);
        }

        return $this;
    }

    public function removeAdresse(Adresse $adresse): self
    {
        if ($this->adressen->removeElement($adresse)) {
            if ($adresse->getBundesland() === $this) {
                $adresse->setBundesland(null);
            }
        }

        return $this;
    }
}
