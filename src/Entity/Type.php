<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */
class Type
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Animal::class, mappedBy="type")
     */
    private $animals;

    /**
     * @ORM\OneToMany(targetEntity=LostAnimal::class, mappedBy="type")
     */
    private $lostAnimals;

    /**
     * @ORM\OneToMany(targetEntity=Race::class, mappedBy="type")
     */
    private $races;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
        $this->lostAnimals = new ArrayCollection();
        $this->races = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $animal->setType($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getType() === $this) {
                $animal->setType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LostAnimal>
     */
    public function getLostAnimals(): Collection
    {
        return $this->lostAnimals;
    }

    public function addLostAnimal(LostAnimal $lostAnimal): self
    {
        if (!$this->lostAnimals->contains($lostAnimal)) {
            $this->lostAnimals[] = $lostAnimal;
            $lostAnimal->setType($this);
        }

        return $this;
    }

    public function removeLostAnimal(LostAnimal $lostAnimal): self
    {
        if ($this->lostAnimals->removeElement($lostAnimal)) {
            // set the owning side to null (unless already changed)
            if ($lostAnimal->getType() === $this) {
                $lostAnimal->setType(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Race>
     */
    public function getRaces(): Collection
    {
        return $this->races;
    }

    public function addRace(Race $race): self
    {
        if (!$this->races->contains($race)) {
            $this->races[] = $race;
            $race->setType($this);
        }

        return $this;
    }

    public function removeRace(Race $race): self
    {
        if ($this->races->removeElement($race)) {
            // set the owning side to null (unless already changed)
            if ($race->getType() === $this) {
                $race->setType(null);
            }
        }

        return $this;
    }
}
