<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProblematiqueUpdateRepository")
 */
class ProblematiqueUpdate
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
    private $date_update;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateUpdate(): ?string
    {
        return $this->date_update;
    }

    public function setDateUpdate(string $date_update): self
    {
        $this->date_update = $date_update;

        return $this;
    }
}
