<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ValidationAnnonceRepository")
 */
class ValidationAnnonce
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_validation;

    /**
     * @ORM\Column(type="float")
     */
    private $nombre_de_kilo_max;

    /**
     * @ORM\Column(type="integer")
     */
    private $statut_validation;

    /**
     * @ORM\Column(type="string")
     */
    private $id_emmeteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description_colis;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Annonce")
     * @ORM\JoinColumn(nullable=false)
     */
    private $annonce;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateValidation(): ?\DateTimeInterface
    {
        return $this->date_validation;
    }

    public function setDateValidation(\DateTimeInterface $date_validation): self
    {
        $this->date_validation = $date_validation;

        return $this;
    }

    public function getNombreDeKiloMax(): ?float
    {
        return $this->nombre_de_kilo_max;
    }

    public function setNombreDeKiloMax(float $nombre_de_kilo_max): self
    {
        $this->nombre_de_kilo_max = $nombre_de_kilo_max;

        return $this;
    }

    public function getStatutValidation(): ?int
    {
        return $this->statut_validation;
    }

    public function setStatutValidation(int $statut_validation): self
    {
        $this->statut_validation = $statut_validation;

        return $this;
    }

    public function getAnnonce(): ?Annonce
    {
        return $this->annonce;
    }

    public function setAnnonce(?Annonce $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }

    public function getDescriptionColis(): ?string
    {
        return $this->description_colis;
    }

    public function setDescriptionColis(string $description_colis): self
    {
        $this->description_colis = $description_colis;

        return $this;
    }

    public function getIdEmmeteur(): ?string
    {
        return $this->id_emmeteur;
    }

    public function setIdEmmeteur(string $id_emmeteur): self
    {
        $this->id_emmeteur = $id_emmeteur;

        return $this;
    }
}
