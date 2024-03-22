<?php

namespace App\Entity;

use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeRepository::class)]
class Groupe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomgroupe = null;

    #[ORM\Column]
    private ?int $nbrpersonnes = null;

    #[ORM\Column(length: 255)]
    private ?string $nompays = null;

    #[ORM\Column(length: 255)]
    private ?string $responsable = null;

    #[ORM\OneToMany(mappedBy: 'groupe', targetEntity: Attribution::class)]
    private Collection $attributions;

    #[ORM\OneToMany(mappedBy: 'ManyToOne', targetEntity: GroupMember::class)]
    private Collection $members;

    public function __construct()
    {
        $this->attributions = new ArrayCollection();
        $this->members = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomgroupe(): ?string
    {
        return $this->nomgroupe;
    }

    public function setNomgroupe(string $nomgroupe): self
    {
        $this->nomgroupe = $nomgroupe;

        return $this;
    }

    public function getNbrpersonnes(): ?int
    {
        return $this->nbrpersonnes;
    }

    public function setNbrpersonnes(int $nbrpersonnes): self
    {
        $this->nbrpersonnes = $nbrpersonnes;

        return $this;
    }

    public function getNompays(): ?string
    {
        return $this->nompays;
    }

    public function setNompays(string $nompays): self
    {
        $this->nompays = $nompays;

        return $this;
    }

    public function getResponsable(): ?string
    {
        return $this->responsable;
    }

    public function setResponsable(string $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * @return Collection<int, Attribution>
     */
    public function getAttributions(): Collection
    {
        return $this->attributions;
    }

    public function addAttribution(Attribution $attribution): self
    {
        if (!$this->attributions->contains($attribution)) {
            $this->attributions->add($attribution);
            $attribution->setGroupe($this);
        }

        return $this;
    }

    public function removeAttribution(Attribution $attribution): self
    {
        if ($this->attributions->removeElement($attribution)) {
            // set the owning side to null (unless already changed)
            if ($attribution->getGroupe() === $this) {
                $attribution->setGroupe(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNomgroupe();
    }

    /**
     * @return Collection<int, GroupMember>
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(GroupMember $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members->add($member);
            $member->setManyToOne($this);
        }

        return $this;
    }

    public function removeMember(GroupMember $member): self
    {
        if ($this->members->removeElement($member)) {
            // set the owning side to null (unless already changed)
            if ($member->getManyToOne() === $this) {
                $member->setManyToOne(null);
            }
        }

        return $this;
    }
}
