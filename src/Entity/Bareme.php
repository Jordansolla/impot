<?php

namespace App\Entity;

use App\Repository\BaremeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity=Tranche::class, mappedBy="bareme")
     */
    private $tranches;

    public function __construct()
    {
        $this->tranches = new ArrayCollection();
    }

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

    /**
     * @return Collection|Tranche[]
     */
    public function getTranches(): Collection
    {
        return $this->tranches;
    }

    public function addTranch(Tranche $tranch): self
    {
        if (!$this->tranches->contains($tranch)) {
            $this->tranches[] = $tranch;
            $tranch->setBareme($this);
        }

        return $this;
    }

    public function removeTranch(Tranche $tranch): self
    {
        if ($this->tranches->removeElement($tranch)) {
            // set the owning side to null (unless already changed)
            if ($tranch->getBareme() === $this) {
                $tranch->setBareme(null);
            }
        }

        return $this;
    }
}
