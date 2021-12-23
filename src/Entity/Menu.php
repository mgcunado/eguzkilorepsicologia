<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MenuRepository")
 */
class Menu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /** @ORM\Column(length=30, name="titulo_es") */
    private $tituloEs;

    /** @ORM\Column(length=30) */
    private $enlace;

    //getters & setters
    public function getId()
    {
        return $this->id;
    }

    public function getTituloEs()
    {
        return $this->tituloEs;
    }

    public function setTituloEs($tituloEs)
    {
        $this->tituloEs = $tituloEs;
    }

    public function getEnlace()
    {
        return $this->enlace;
    }

    public function setEnlace($enlace)
    {
        $this->enlace = $enlace;
    }
}
