<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservaRepository::class)
 */
class Reserva
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=usuario::class, inversedBy="reservas")
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity=tarea::class, inversedBy="reservas")
     */
    private $tarea;

    /**
     * @ORM\ManyToOne(targetEntity=tramo::class, inversedBy="reservas")
     */
    private $tramo;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

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

    public function getTarea(): ?tarea
    {
        return $this->tarea;
    }

    public function setTarea(?tarea $tarea): self
    {
        $this->tarea = $tarea;

        return $this;
    }

    public function getTramo(): ?tramo
    {
        return $this->tramo;
    }

    public function setTramo(?tramo $tramo): self
    {
        $this->tramo = $tramo;

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
}
