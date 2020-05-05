<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetRepository")
 */
class Projet
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
    private $Projet_nom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjetNom(): ?string
    {
        return $this->Projet_nom;
    }

    public function setProjetNom(string $Projet_nom): self
    {
        $this->Projet_nom = $Projet_nom;

        return $this;
    }
}
