<?php

namespace App\Entity;

use App\Repository\FotosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FotosRepository::class)
 */
class Fotos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $foto;

    /**
     * @ORM\ManyToOne(targetEntity=animal::class, inversedBy="fotos")
     */
    private $animal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getAnimal(): ?animal
    {
        return $this->animal;
    }

    public function setAnimal(?animal $animal): self
    {
        $this->animal = $animal;

        return $this;
    }
}
