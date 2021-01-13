<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImagesRepository")
 */
class Images
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $filename;

    /**
     * @ORM\Column(type="integer")
     */
    private $imgorder;

    /**
     * @ORM\Column(type="integer")
     */
    private $imgorderrand;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $incluido;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $tipo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime")
     */
    private $modified;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getImgorder(): ?int
    {
        return $this->imgorder;
    }

    public function setImgorder(int $imgorder): self
    {
        $this->imgorder = $imgorder;

        return $this;
    }

    public function getImgorderrand(): ?int
    {
        return $this->imgorderrand;
    }

    public function setImgorderrand(int $imgorderrand): self
    {
        $this->imgorderrand = $imgorderrand;

        return $this;
    }

    public function getIncluido(): ?string
    {
        return $this->incluido;
    }

    public function setIncluido(string $incluido): self
    {
        $this->incluido = $incluido;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getModified(): ?\DateTimeInterface
    {
        return $this->modified;
    }

    public function setModified(\DateTimeInterface $modified): self
    {
        $this->modified = $modified;

        return $this;
    }
}
