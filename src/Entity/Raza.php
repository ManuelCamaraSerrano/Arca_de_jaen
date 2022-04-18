<?php

namespace App\Entity;

use App\Repository\RazaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RazaRepository::class)
 */
class Raza
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
     * @ORM\OneToMany(targetEntity=Animal::class, mappedBy="raza")
     */
    private $animals;

    /**
     * @ORM\OneToMany(targetEntity=AnimalPerdido::class, mappedBy="raza")
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
            $animal->setRaza($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getRaza() === $this) {
                $animal->setRaza(null);
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
            $animalPerdido->setRaza($this);
        }

        return $this;
    }

    public function removeAnimalPerdido(AnimalPerdido $animalPerdido): self
    {
        if ($this->animalPerdidos->removeElement($animalPerdido)) {
            // set the owning side to null (unless already changed)
            if ($animalPerdido->getRaza() === $this) {
                $animalPerdido->setRaza(null);
            }
        }

        return $this;
    }
}
