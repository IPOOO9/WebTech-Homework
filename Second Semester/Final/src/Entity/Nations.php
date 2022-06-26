<?php

namespace App\Entity;

use App\Repository\NationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NationsRepository::class)
 */
class Nations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $Nation_name;

    /**
     * @ORM\OneToMany(targetEntity=Aircraft::class, mappedBy="nation_manufacturer", orphanRemoval=true)
     */
    private $aircraft;

    public function __construct()
    {
        $this->aircraft = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNationName(): ?string
    {
        return $this->Nation_name;
    }

    public function setNationName(string $Nation_name): self
    {
        $this->Nation_name = $Nation_name;

        return $this;
    }

    /**
     * @return Collection<int, Aircraft>
     */
    public function getAircraft(): Collection
    {
        return $this->aircraft;
    }

    public function addAircraft(Aircraft $aircraft): self
    {
        if (!$this->aircraft->contains($aircraft)) {
            $this->aircraft[] = $aircraft;
            $aircraft->setNationManufacturer($this);
        }

        return $this;
    }

    public function removeAircraft(Aircraft $aircraft): self
    {
        if ($this->aircraft->removeElement($aircraft)) {
            // set the owning side to null (unless already changed)
            if ($aircraft->getNationManufacturer() === $this) {
                $aircraft->setNationManufacturer(null);
            }
        }

        return $this;
    }

    public function __toString():string
    {
        return $this->Nation_name;
    }
}
