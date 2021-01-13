<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FacturasRepository")
 */
class Facturas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $numerofactura;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Clientes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $fechafactura;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $referencia;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $producto;

    /**
     * @ORM\Column(type="integer")
     */
    private $duracion;

    /**
     * @ORM\Column(type="float", precision=2, scale=1)
     */
    private $importe;

    /**
     * @ORM\Column(type="string", length=50, options={"default"="Metálico"})
     */
    private $modopago;

    /**
     * @ORM\Column(type="string", length=2, options={"default"="si"})
     */
    private $cobrado;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumerofactura(): ?string
    {
        return $this->numerofactura;
    }

    public function setNumerofactura(string $numerofactura): self
    {
        $this->numerofactura = $numerofactura;

        return $this;
    }

    public function getNombre(): ?Clientes
    {
        return $this->nombre;
    }

    public function setNombre(?Clientes $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getFechafactura(): ?\DateTimeInterface
    {
        return $this->fechafactura;
    }

    public function setFechafactura(\DateTimeInterface $fechafactura): self
    {
        $this->fechafactura = $fechafactura;

        return $this;
    }

    public function getReferencia(): ?string
    {
        return $this->referencia;
    }

    public function setReferencia(string $referencia): self
    {
        $this->referencia = $referencia;

        return $this;
    }

    public function getProducto(): ?string
    {
        return $this->producto;
    }

    public function setProducto(string $producto): self
    {
        $this->producto = $producto;

        return $this;
    }

    public function getDuracion(): ?int
    {
        return $this->duracion;
    }

    public function setDuracion(int $duracion): self
    {
        $this->duracion = $duracion;

        return $this;
    }

    public function getImporte(): ?float
    {
        return $this->importe;
    }

    public function setImporte(float $importe): self
    {
        $this->importe = $importe;

        return $this;
    }

    public function getModopago(): ?string
    {
        return $this->modopago;
    }

    public function setModopago(string $modopago): self
    {
        $this->modopago = $modopago;

        return $this;
    }

    public function getCobrado(): ?string
    {
        return $this->cobrado;
    }

    public function setCobrado(string $cobrado): self
    {
        $this->cobrado = $cobrado;

        return $this;
    }

     public function __toString()
    {
       return (string)$this->getNombre();
    }    

     public function __construct()
    {
      $this->fechafactura = new \DateTime();
    }
    
}
