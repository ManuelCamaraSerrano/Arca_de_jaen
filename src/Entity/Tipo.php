<?php

namespace App\Entity;

use App\Repository\TipoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TipoRepository::class)
 */
class Tipo
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
     * @ORM\OneToMany(targetEntity=Animal::class, mappedBy="tipo")
     */
    private $animals;

    /**
     * @ORM\OneToMany(targetEntity=AnimalPerdido::class, mappedBy="tipo")
     */
    private $animalPerdidos;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
        $this->animalPerdidos = new ArrayCollection();
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

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animal $animal): self
    {
        if (!$this->animals->contains($animal)) {
            $this->animals[] = $animal;
            $animal->setTipo($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getTipo() === $this) {
                $animal->setTipo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AnimalPerdido>
     */
    public function getAnimalPerdidos(): Collection
    {
        return $this->animalPerdidos;
    }

    public function addAnimalPerdido(AnimalPerdido $animalPerdido): self
    {
        if (!$this->animalPerdidos->contains($animalPerdido)) {
            $this->animalPerdidos[] = $animalPerdido;
            $animalPerdido->setTipo($this);
        }

        return $this;
    }

    public function removeAnimalPerdido(AnimalPerdido $animalPerdido): self
    {
        if ($this->animalPerdidos->removeElement($animalPerdido)) {
            // set the owning side to null (unless already changed)
            if ($animalPerdido->getTipo() === $this) {
                $animalPerdido->setTipo(null);
            }
        }

        return $this;
    }
}
