<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PreguntatestRepository")
 */
class Preguntatest
{
  /**
   * @ORM\Id()
   * @ORM\GeneratedValue()
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=80)
   */
  private $testtipo;

  /**
   * @ORM\Column(type="string", length=80)
   */
  private $pregunta;

  /**
   * @ORM\Column(type="integer")
   */
  private $respuesta;

  /**
   * @ORM\ManyToOne(targetEntity="App\Entity\Categoria")
   * @ORM\JoinColumn(nullable=false)
   */
  private $categoria;

  /**
   * @ORM\Column(type="string", length=80, nullable=false)
   */
  private $subcategoria;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getTesttipo(): ?string
  {
    return $this->testtipo;
  }

  public function setTesttipo(string $testtipo): self
  {
    $this->testtipo = $testtipo;

    return $this;
  }

 public function getPregunta(): ?string
  {
    return $this->pregunta;
  }

  public function setPregunta(string $pregunta): self
  {
    $this->pregunta = $pregunta;

    return $this;
  }

    /**
     * Set respuesta
     * @param integer $respuesta
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;

        return $this;
    }

    /**
     * Get respuesta
     * @return int
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }


  public function getCategoria(): ?Categoria
  {
    return $this->categoria;
  }

  public function setCategoria(?Categoria $categoria): self
  {
    $this->categoria = $categoria;

    return $this;
  }

  public function getSubcategoria(): ?string
  {
    return $this->subcategoria;
  }

  public function setSubcategoria(string $subcategoria): self
  {
    $this->subcategoria = $subcategoria;

    return $this;
  }

}
