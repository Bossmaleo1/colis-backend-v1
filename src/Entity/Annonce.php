<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnnonceRepository")
 */
class Annonce
{

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $heure_depart;

    /**
     * @ORM\Column(type="time")
     */
    private $heure_arrivee;

    /**
 * @ORM\Column(type="float")
 */
    private $nombre_kilo;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieux_rdv1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieux_rdv2;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateannonce;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateannonce2;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_aeroport_depart;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_aeroport_arrivee;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeureDepart(): ?\DateTimeInterface
    {
        return $this->heure_depart;
    }

    public function setHeureDepart(\DateTimeInterface $heure_depart): self
    {
        $this->heure_depart = $heure_depart;

        return $this;
    }

    public function getHeureArrivee(): ?\DateTimeInterface
    {
        return $this->heure_arrivee;
    }

    public function setHeureArrivee(\DateTimeInterface $heure_arrivee): self
    {
        $this->heure_arrivee = $heure_arrivee;

        return $this;
    }

    public function getNombreKilo(): ?float
    {
        return $this->nombre_kilo;
    }

    public function setNombreKilo(float $nombre_kilo): self
    {
        $this->nombre_kilo = $nombre_kilo;

        return $this;
    }

    public function getLieuxRdv1(): ?string
    {
        return $this->lieux_rdv1;
    }

    public function setLieuxRdv1(string $lieux_rdv1): self
    {
        $this->lieux_rdv1 = $lieux_rdv1;

        return $this;
    }

    public function getLieuxRdv2(): ?string
    {
        return $this->lieux_rdv2;
    }

    public function setLieuxRdv2(string $lieux_rdv2): self
    {
        $this->lieux_rdv2 = $lieux_rdv2;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getDateannonce(): ?\DateTimeInterface
    {
        return $this->dateannonce;
    }

    public function setDateannonce(\DateTimeInterface $dateannonce): self
    {
        $this->dateannonce = $dateannonce;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIdAeroportDepart(): ?int
    {
        return $this->id_aeroport_depart;
    }

    public function setIdAeroportDepart(int $id_aeroport_depart): self
    {
        $this->id_aeroport_depart = $id_aeroport_depart;

        return $this;
    }

    public function getIdAeroportArrivee(): ?int
    {
        return $this->id_aeroport_arrivee;
    }

    public function setIdAeroportArrivee(int $id_aeroport_arrivee): self
    {
        $this->id_aeroport_arrivee = $id_aeroport_arrivee;

        return $this;
    }

    public function getDateannonce2(): ?\DateTimeInterface
    {
        return $this->dateannonce2;
    }

    public function setDateannonce2(\DateTimeInterface $dateannonce2): self
    {
        $this->dateannonce2 = $dateannonce2;

        return $this;
    }
}
