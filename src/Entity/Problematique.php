<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProblematiqueRepository")
 */
class Problematique
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorieprob")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorieprob;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getCategorieprob(): ?Categorieprob
    {
        return $this->categorieprob;
    }

    public function setCategorieprob(?Categorieprob $categorieprob): self
    {
        $this->categorieprob = $categorieprob;

        return $this;
    }


}
