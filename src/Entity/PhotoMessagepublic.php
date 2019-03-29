<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoMessagepublicRepository")
 */
class PhotoMessagepublic
{

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Messagepublic")
     * @ORM\JoinColumn(nullable=false)
     */
    private $messagepublic;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Libelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Extension;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(?string $Libelle): self
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    public function getMessagepublic(): ?Messagepublic
    {
        return $this->messagepublic;
    }

    public function setMessagepublic(?Messagepublic $messagepublic): self
    {
        $this->messagepublic = $messagepublic;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->Extension;
    }

    public function setExtension(?string $Extension): self
    {
        $this->Extension = $Extension;

        return $this;
    }
}
