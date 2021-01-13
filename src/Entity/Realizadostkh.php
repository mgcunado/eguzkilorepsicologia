<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestkarlherefordRepository")
 */
class Realizadostkh 
{
  /**
   * @ORM\Id()
   * @ORM\GeneratedValue()
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=99)
   */
  private $nombre;

  /**
   * @ORM\Column(type="integer")
   */
  private $edad;

   /**
   * @ORM\Column(type="string", length=9)
   */
  private $sexo;
 
   /**
   * @ORM\Column(type="string", length=91)
   */
  private $respuestas;
 
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
     * Set edad
     * @param integer $edad
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get edad
     * @return int
     */
    public function getEdad()
    {
        return $this->edad;
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

 public function getRespuestas(): ?string
  {
    return $this->respuestas;
  }

  public function setRespuestas(string $respuestas): self
  {
    $this->respuestas = $respuestas;

    return $this;
  }

}
