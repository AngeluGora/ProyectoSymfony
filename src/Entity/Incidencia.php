<?php
namespace App\Entity;

use App\Repository\IncidenciaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IncidenciaRepository::class)]
class Incidencia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(type:"datetime")] // Cambiado a tipo datetime
    private ?\DateTimeInterface $fechaCreacion = null; // Cambiado a tipo \DateTimeInterface

    #[ORM\Column(length: 255)]
    private ?string $estado = null;

    #[ORM\ManyToOne(inversedBy: 'incidencia', cascade: ["persist"])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuario = null;

    #[ORM\ManyToOne(inversedBy: 'incidencia', cascade: ["persist"])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cliente $cliente = null;

    // Getters y setters...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion(?\DateTimeInterface $fechaCreacion): self
    {
        $this->fechaCreacion = $fechaCreacion;

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

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }
}
