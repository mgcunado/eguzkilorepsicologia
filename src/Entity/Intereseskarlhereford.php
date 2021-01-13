<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IntereseskarlherefordRepository")
 */
class Intereseskarlhereford
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
    private $interes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInteres(): ?string
    {
        return $this->interes;
    }

    public function setInteres(string $interes): self
    {
        $this->interes = $interes;

        return $this;
    }

    public function __toString()
    {
       return (string)$this->getInteres();
    }


}
