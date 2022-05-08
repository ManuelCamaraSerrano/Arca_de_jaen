<?php

namespace App\Entity;

use App\Repository\RaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RaceRepository::class)
 */
class Race
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
     * @ORM\OneToMany(targetEntity=Animal::class, mappedBy="race")
     */
    private $animals;

    /**
     * @ORM\OneToMany(targetEntity=LostAnimal::class, mappedBy="race")
     */
    private $lostAnimals;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="races")
     */
    private $type;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
        $this->lostAnimals = new ArrayCollection();
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
            $animal->setRace($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getRace() === $this) {
                $animal->setRace(null);
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
            $lostAnimal->setRace($this);
        }

        return $this;
    }

    public function removeLostAnimal(LostAnimal $lostAnimal): self
    {
        if ($this->lostAnimals->removeElement($lostAnimal)) {
            // set the owning side to null (unless already changed)
            if ($lostAnimal->getRace() === $this) {
                $lostAnimal->setRace(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getType(): ?type
    {
        return $this->type;
    }

    public function setType(?type $type): self
    {
        $this->type = $type;

        return $this;
    }
}
