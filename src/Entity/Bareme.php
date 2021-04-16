<?php

namespace App\Entity;

use App\Repository\BaremeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BaremeRepository::class)
 */
class Bareme
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
    private $anneeAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneeAt(): ?\DateTimeInterface
    {
        return $this->anneeAt;
    }

    public function setAnneeAt(\DateTimeInterface $anneeAt): self
    {
        $this->anneeAt = $anneeAt;

        return $this;
    }
}
