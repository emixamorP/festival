<?php

namespace App\Entity;

use App\Repository\GroupMemberRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupMemberRepository::class)]
class GroupMember
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column]
    private ?bool $civilite = null;

    #[ORM\ManyToOne(inversedBy: 'members')]
    private ?groupe $ManyToOne = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function isCivilite(): ?bool
    {
        return $this->civilite;
    }

    public function setCivilite(bool $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getManyToOne(): ?groupe
    {
        return $this->ManyToOne;
    }

    public function setManyToOne(?groupe $ManyToOne): self
    {
        $this->ManyToOne = $ManyToOne;

        return $this;
    }
}
