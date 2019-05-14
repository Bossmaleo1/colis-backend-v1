<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NotificationRepository")
 */
class Notification
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $ID_Libelle;

    /**
     * @ORM\Column(type="integer")
     */
    private $ID_Type;

    /**
     * @ORM\Column(type="string", length=255)
*/
    private $Libelle;

    /**
     * @ORM\Column(type="integer")
     */
    private $Etat;

    /**
     * @ORM\Column(type="integer")
     */
    private $ID_User;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_emmetteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIDLibelle(): ?int
    {
        return $this->ID_Libelle;
    }

    public function setIDLibelle(int $ID_Libelle): self
    {
        $this->ID_Libelle = $ID_Libelle;

        return $this;
    }

    public function getIDType(): ?int
    {
        return $this->ID_Type;
    }

    public function setIDType(int $ID_Type): self
    {
        $this->ID_Type = $ID_Type;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): self
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->Etat;
    }

    public function setEtat(int $Etat): self
    {
        $this->Etat = $Etat;

        return $this;
    }

    public function getIDUser(): ?int
    {
        return $this->ID_User;
    }

    public function setIDUser(int $ID_User): self
    {
        $this->ID_User = $ID_User;

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

    public function getIdEmmetteur(): ?int
    {
        return $this->id_emmetteur;
    }

    public function setIdEmmetteur(int $id_emmetteur): self
    {
        $this->id_emmetteur = $id_emmetteur;

        return $this;
    }
}
