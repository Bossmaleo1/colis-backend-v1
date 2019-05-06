<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VilleAnnonceRepository")
 */
class VilleAnnonce
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Annonce")
     * @ORM\JoinColumn(nullable=false)
     */
    private $annonce;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aeroportinternationnal")
     * @ORM\JoinColumn(nullable=false)
     */
    private $aeroportinternational;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAeroportinternational(): ?Aeroportinternationnal
    {
        return $this->aeroportinternational;
    }

    public function setAeroportinternational(?Aeroportinternationnal $aeroportinternational): self
    {
        $this->aeroportinternational = $aeroportinternational;

        return $this;
    }


}
