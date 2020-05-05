<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TodoRepository")
 */
class Todo
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
    private $Todo_titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Todo_description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Todo_dateLimite;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Projet")
     * @ORM\JoinColumn(name="projet_id", referencedColumnName="id")
     */
    private $Projet_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTodoTitre(): ?string
    {
        return $this->Todo_titre;
    }

    public function setTodoTitre(string $Todo_titre): self
    {
        $this->Todo_titre = $Todo_titre;

        return $this;
    }

    public function getTodoDescription(): ?string
    {
        return $this->Todo_description;
    }

    public function setTodoDescription(?string $Todo_description): self
    {
        $this->Todo_description = $Todo_description;

        return $this;
    }

    public function getTodoDateLimite(): ?\DateTimeInterface
    {
        return $this->Todo_dateLimite;
    }

    public function setTodoDateLimite(?\DateTimeInterface $Todo_dateLimite): self
    {
        $this->Todo_dateLimite = $Todo_dateLimite;

        return $this;
    }

    public function getProjetId(): ?int
    {
        return $this->Projet_id;
    }

    public function setProjetId(int $Projet_id): self
    {
        $this->Projet_id = $Projet_id;

        return $this;
    }
}
