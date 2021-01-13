<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TextoRepository")
 */
class Texto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    
    /** @ORM\Column(type="text", name="texto_es") */
    private $textoEs;

    /** @ORM\Column(length=30) */
    private $enlace;       
    
    //getters & setters
    public function getId()
    {
        return $this->id;
    }

    public function getTextoEs()
    {
        return $this->textoEs;
    }

    public function setTextoEs($textoEs)
    {
        $this->textoEs = $textoEs;
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
