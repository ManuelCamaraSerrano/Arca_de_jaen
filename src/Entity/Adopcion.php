<?php

namespace App\Entity;

use App\Repository\AdopcionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdopcionRepository::class)
 */
class Adopcion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=usuario::class, inversedBy="adopciones")
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity=animal::class, inversedBy="adopciones")
     */
    private $animal;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contrato;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $estado;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?usuario $usuario): self
    {
        $this->usuario = $usuario;

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

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getContrato(): ?string
    {
        return $this->contrato;
    }

    public function setContrato(?string $contrato): self
    {
        $this->contrato = $contrato;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }
}
