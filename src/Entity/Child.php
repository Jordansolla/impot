<?php

namespace App\Entity;

use App\Repository\ChildRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChildRepository::class)
 */
class Child
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $BirthdayAt;

    /**
     * @ORM\ManyToOne(targetEntity=Contribuable::class, inversedBy="children")
     */
    private $contribuable;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getBirthdayAt(): ?\DateTimeInterface
    {
        return $this->BirthdayAt;
    }

    public function setBirthdayAt(\DateTimeInterface $BirthdayAt): self
    {
        $this->BirthdayAt = $BirthdayAt;

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
