<?php

namespace App\Entity;

use App\Repository\ReserveRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReserveRepository::class)
 */
class Reserve
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="reserves")
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity=Job::class, inversedBy="reserves")
     */
    private $job;

    /**
     * @ORM\ManyToOne(targetEntity=Stretch::class, inversedBy="reserves")
     */
    private $stretch;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

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

    public function getJob(): ?job
    {
        return $this->job;
    }

    public function setJob(?job $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getStretch(): ?stretch
    {
        return $this->stretch;
    }

    public function setStretch(?stretch $stretch): self
    {
        $this->stretch = $stretch;

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
}
