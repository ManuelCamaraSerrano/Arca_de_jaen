<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnimalRepository::class)
 */
class Animal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $nombre;

    /**
     * @ORM\Column(type="date")
     */
    private $fechanac;

    /**
     * @ORM\ManyToOne(targetEntity=tipo::class, inversedBy="animals")
     */
    private $tipo;

    /**
     * @ORM\ManyToOne(targetEntity=raza::class, inversedBy="animals")
     */
    private $raza;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $sexo;

    /**
     * @ORM\Column(type="integer")
     */
    private $peso;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $chip;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="integer")
     */
    private $altura;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaentrada;

    /**
     * @ORM\ManyToOne(targetEntity=espacioFisico::class, inversedBy="animals")
     */
    private $espaciofisico;

    /**
     * @ORM\OneToMany(targetEntity=Fotos::class, mappedBy="animal")
     */
    private $fotos;

    /**
     * @ORM\OneToMany(targetEntity=Solicitud::class, mappedBy="animal")
     */
    private $solicitudes;

    /**
     * @ORM\OneToMany(targetEntity=Adopcion::class, mappedBy="animal")
     */
    private $adopciones;

    public function __construct()
    {
        $this->fotos = new ArrayCollection();
        $this->solicitudes = new ArrayCollection();
        $this->adopciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getFechanac(): ?\DateTimeInterface
    {
        return $this->fechanac;
    }

    public function setFechanac(\DateTimeInterface $fechanac): self
    {
        $this->fechanac = $fechanac;

        return $this;
    }

    public function getTipo(): ?tipo
    {
        return $this->tipo;
    }

    public function setTipo(?tipo $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getRaza(): ?raza
    {
        return $this->raza;
    }

    public function setRaza(?raza $raza): self
    {
        $this->raza = $raza;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getPeso(): ?int
    {
        return $this->peso;
    }

    public function setPeso(int $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getChip(): ?string
    {
        return $this->chip;
    }

    public function setChip(string $chip): self
    {
        $this->chip = $chip;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getAltura(): ?int
    {
        return $this->altura;
    }

    public function setAltura(int $altura): self
    {
        $this->altura = $altura;

        return $this;
    }

    public function getFechaentrada(): ?\DateTimeInterface
    {
        return $this->fechaentrada;
    }

    public function setFechaentrada(\DateTimeInterface $fechaentrada): self
    {
        $this->fechaentrada = $fechaentrada;

        return $this;
    }

    public function getEspaciofisico(): ?espacioFisico
    {
        return $this->espaciofisico;
    }

    public function setEspaciofisico(?espacioFisico $espaciofisico): self
    {
        $this->espaciofisico = $espaciofisico;

        return $this;
    }

    /**
     * @return Collection<int, Fotos>
     */
    public function getFotos(): Collection
    {
        return $this->fotos;
    }

    public function addFoto(Fotos $foto): self
    {
        if (!$this->fotos->contains($foto)) {
            $this->fotos[] = $foto;
            $foto->setAnimal($this);
        }

        return $this;
    }

    public function removeFoto(Fotos $foto): self
    {
        if ($this->fotos->removeElement($foto)) {
            // set the owning side to null (unless already changed)
            if ($foto->getAnimal() === $this) {
                $foto->setAnimal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Solicitud>
     */
    public function getSolicitudes(): Collection
    {
        return $this->solicitudes;
    }

    public function addSolicitude(Solicitud $solicitude): self
    {
        if (!$this->solicitudes->contains($solicitude)) {
            $this->solicitudes[] = $solicitude;
            $solicitude->setAnimal($this);
        }

        return $this;
    }

    public function removeSolicitude(Solicitud $solicitude): self
    {
        if ($this->solicitudes->removeElement($solicitude)) {
            // set the owning side to null (unless already changed)
            if ($solicitude->getAnimal() === $this) {
                $solicitude->setAnimal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Adopcion>
     */
    public function getAdopciones(): Collection
    {
        return $this->adopciones;
    }

    public function addAdopcione(Adopcion $adopcione): self
    {
        if (!$this->adopciones->contains($adopcione)) {
            $this->adopciones[] = $adopcione;
            $adopcione->setAnimal($this);
        }

        return $this;
    }

    public function removeAdopcione(Adopcion $adopcione): self
    {
        if ($this->adopciones->removeElement($adopcione)) {
            // set the owning side to null (unless already changed)
            if ($adopcione->getAnimal() === $this) {
                $adopcione->setAnimal(null);
            }
        }

        return $this;
    }
}
