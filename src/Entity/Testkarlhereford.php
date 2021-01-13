<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestkarlherefordRepository")
 */
class Testkarlhereford 
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
  private $pregunta;

  /**
   * @ORM\Column(type="integer")
   */
  private $respuesta;

  /**
   * @ORM\ManyToOne(targetEntity="App\Entity\Intereseskarlhereford")
   * @ORM\JoinColumn(nullable=false)
   */
  private $intereseskarlhereford;

  public function getId(): ?int
  {
    return $this->id;
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


  public function getIntereseskarlhereford(): ?Intereseskarlhereford
  {
    return $this->intereseskarlhereford;
  }

  public function setIntereseskarlhereford(?Intereseskarlhereford $intereseskarlhereford): self
  {
    $this->intereseskarlhereford = $intereseskarlhereford;

    return $this;
  }

}
