<?php

namespace App\Entity;

use App\Repository\SimulationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SimulationRepository::class)
 */
class Simulation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="float")
     */
    private $revenuNetCt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $revenuNetCj;

    /**
     * @ORM\ManyToOne(targetEntity=Bareme::class, inversedBy="simulations")
     */
    private $annee;

    /**
     * @ORM\ManyToOne(targetEntity=Contribuable::class, inversedBy="simulations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contribuable;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getRevenuNetCt(): ?float
    {
        return $this->revenuNetCt;
    }

    public function setRevenuNetCt(float $revenuNetCt): self
    {
        $this->revenuNetCt = $revenuNetCt;

        return $this;
    }

    public function getRevenuNetCj(): ?float
    {
        return $this->revenuNetCj;
    }

    public function setRevenuNetCj(?float $revenuNetCj): self
    {
        $this->revenuNetCj = $revenuNetCj;

        return $this;
    }

    public function getAnnee(): ?Bareme
    {
        return $this->annee;
    }

    public function setAnnee(?Bareme $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getContribuable(): ?Contribuable
    {
        return $this->contribuable;
    }

    public function setContribuable(?Contribuable $contribuable): self
    {
        $this->contribuable = $contribuable;

        return $this;
    }
}
