<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientesRepository")
 */
class Clientes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $direccion;

   /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $telefono;

   /**
     * @ORM\Column(type="string", length=2)
     */
    private $alta;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $email;

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

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

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

    public function getAlta(): ?string
    {
        return $this->alta;
    }

    public function setAlta(string $alta): self
    {
        $this->alta = $alta;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function __toString()
    {
        return (string)$this->getNombre();
    }
    
}
