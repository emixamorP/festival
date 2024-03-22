<?php

namespace App\Entity;

use App\Repository\OffresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffresRepository::class)]
class Offres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbr_chambres = null;

    #[ORM\ManyToOne(inversedBy: 'offres')]
    private ?Etablissement $etablissement = null;

    #[ORM\ManyToOne(inversedBy: 'offres')]
    private ?TypeDeChambre $type_chambres = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrChambres(): ?int
    {
        return $this->nbr_chambres;
    }

    public function setNbrChambres(int $nbr_chambres): self
    {
        $this->nbr_chambres = $nbr_chambres;

        return $this;
    }

    public function getEtablissement(): ?Etablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    public function getTypeChambres(): ?TypeDeChambre
    {
        return $this->type_chambres;
    }

    public function setTypeChambres(?TypeDeChambre $type_chambres): self
    {
        $this->type_chambres = $type_chambres;

        return $this;
    }

    /*
    #[Route('/offretype', name: 'app_typeoffresgroupes ', methods: ['GET'])]
    public function findAllNombreoffreGroupe(OffreRepository $typeChambreRepository): Response
    {
        return $this->render('offre/offretype.html.twig', [
        'offretypechambre' => $typeChambreRepository->findAllNombreoffreGroupe(),]);
    }
    */
}
