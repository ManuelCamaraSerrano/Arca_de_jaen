<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotNull(
     *      message = "El nombre no puede dejarlo vacio"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotNull(
     *      message = "La fecha de nacimiento no puede dejarla vacia"
     * )
     */
    private $birthDate;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="animals")
     * @Assert\NotNull(
     *      message = "La especie no puede dejarla vacia"
     * )
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Race::class, inversedBy="animals")
     * * @Assert\NotNull(
     *      message = "La raza no puede dejarla vacia"
     * )
     */
    private $race;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotNull(
     *      message = "El sexo no puede dejarlo vacio"
     * )
     */
    private $sex;

    /**
     * @ORM\Column(type="integer")
    * @Assert\NotNull(
     *      message = "El peso no puede dejarlo vacio"
     * )
     */
    private $weigth;

    /**
     * @ORM\Column(type="string", length=50)
     *  @Assert\NotNull(
     *      message = "El color no puede dejarlo vacio"
     * )
     */
    private $colour;

    /**
     * @ORM\Column(type="string", length=70)
     *  @Assert\NotNull(
     *      message = "El chip no puede dejarlo vacio"
     * )
     */
    private $chip;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotNull(
     *      message = "La descripcion no puede dejarla vacia"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     *  @Assert\NotNull(
     *      message = "El altura no puede dejarla vacia"
     * )
     */
    private $height;

    /**
     * @ORM\Column(type="date")
     *  @Assert\NotNull(
     *      message = "La fecha de entrada no puede dejarla vacia"
     * )
     */
    private $entryDate;

    /**
     * @ORM\ManyToOne(targetEntity=PhysicalSpace::class, inversedBy="animals")
     *  @Assert\NotNull(
     *      message = "El espacio fisico no puede dejarlo vacio"
     * )
     */
    private $physicalSpace;

    /**
     * @ORM\OneToMany(targetEntity=Photo::class, mappedBy="animal")
     */
    private $photos;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $adopted;


    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->requests = new ArrayCollection();
        $this->adoptions = new ArrayCollection();
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

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
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

    public function getRace(): ?race
    {
        return $this->race;
    }

    public function setRace(?race $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getWeigth(): ?int
    {
        return $this->weigth;
    }

    public function setWeigth(int $weigth): self
    {
        $this->weigth = $weigth;

        return $this;
    }

    public function getColour(): ?string
    {
        return $this->colour;
    }

    public function setColour(string $colour): self
    {
        $this->colour = $colour;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getEntryDate(): ?\DateTimeInterface
    {
        return $this->entryDate;
    }

    public function setEntryDate(\DateTimeInterface $entryDate): self
    {
        $this->entryDate = $entryDate;

        return $this;
    }

    public function getPhysicalSpace(): ?physicalSpace
    {
        return $this->physicalSpace;
    }

    public function setPhysicalSpace(?physicalSpace $physicalSpace): self
    {
        $this->physicalSpace = $physicalSpace;

        return $this;
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setAnimal($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getAnimal() === $this) {
                $photo->setAnimal(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return $this->name." Chip: ".$this->chip;
    }

    public function getAdopted(): ?string
    {
        return $this->adopted;
    }

    public function setAdopted(string $adopted): self
    {
        $this->adopted = $adopted;

        return $this;
    }
}
