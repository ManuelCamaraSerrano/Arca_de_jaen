<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UsuarioRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=9)
     */
    private $dni;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $ap1;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ap2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $foto;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $telefono;

    /**
     * @ORM\OneToMany(targetEntity=Reserva::class, mappedBy="usuario")
     */
    private $reservas;

    /**
     * @ORM\OneToMany(targetEntity=Solicitud::class, mappedBy="usuario")
     */
    private $solicitudes;

    /**
     * @ORM\OneToMany(targetEntity=Adopcion::class, mappedBy="usuario")
     */
    private $adopciones;

    /**
     * @ORM\OneToMany(targetEntity=AnimalPerdido::class, mappedBy="usuario")
     */
    private $animalPerdidos;

    public function __construct()
    {
        $this->reservas = new ArrayCollection();
        $this->solicitudes = new ArrayCollection();
        $this->adopciones = new ArrayCollection();
        $this->animalPerdidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(string $dni): self
    {
        $this->dni = $dni;

        return $this;
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

    public function getAp1(): ?string
    {
        return $this->ap1;
    }

    public function setAp1(string $ap1): self
    {
        $this->ap1 = $ap1;

        return $this;
    }

    public function getAp2(): ?string
    {
        return $this->ap2;
    }

    public function setAp2(?string $ap2): self
    {
        $this->ap2 = $ap2;

        return $this;
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

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * @return Collection<int, Reserva>
     */
    public function getReservas(): Collection
    {
        return $this->reservas;
    }

    public function addReserva(Reserva $reserva): self
    {
        if (!$this->reservas->contains($reserva)) {
            $this->reservas[] = $reserva;
            $reserva->setUsuario($this);
        }

        return $this;
    }

    public function removeReserva(Reserva $reserva): self
    {
        if ($this->reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getUsuario() === $this) {
                $reserva->setUsuario(null);
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
            $solicitude->setUsuario($this);
        }

        return $this;
    }

    public function removeSolicitude(Solicitud $solicitude): self
    {
        if ($this->solicitudes->removeElement($solicitude)) {
            // set the owning side to null (unless already changed)
            if ($solicitude->getUsuario() === $this) {
                $solicitude->setUsuario(null);
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
            $adopcione->setUsuario($this);
        }

        return $this;
    }

    public function removeAdopcione(Adopcion $adopcione): self
    {
        if ($this->adopciones->removeElement($adopcione)) {
            // set the owning side to null (unless already changed)
            if ($adopcione->getUsuario() === $this) {
                $adopcione->setUsuario(null);
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
            $animalPerdido->setUsuario($this);
        }

        return $this;
    }

    public function removeAnimalPerdido(AnimalPerdido $animalPerdido): self
    {
        if ($this->animalPerdidos->removeElement($animalPerdido)) {
            // set the owning side to null (unless already changed)
            if ($animalPerdido->getUsuario() === $this) {
                $animalPerdido->setUsuario(null);
            }
        }

        return $this;
    }
}
