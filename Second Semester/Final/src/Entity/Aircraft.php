<?php

namespace App\Entity;

use App\Repository\AircraftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AircraftRepository::class)
 */
class Aircraft
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity=Nations::class, inversedBy="aircraft")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nation_manufacturer;

    /**
     * @ORM\ManyToMany(targetEntity=Aces::class, mappedBy="fly_on")
     */
    private $aces;

    public function __construct()
    {
        $this->aces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getNationManufacturer(): ?Nations
    {
        return $this->nation_manufacturer;
    }

    public function setNationManufacturer(?Nations $nation_manufacturer): self
    {
        $this->nation_manufacturer = $nation_manufacturer;

        return $this;
    }

    /**
     * @return Collection<int, Aces>
     */
    public function getAces(): Collection
    {
        return $this->aces;
    }

    public function addAce(Aces $ace): self
    {
        if (!$this->aces->contains($ace)) {
            $this->aces[] = $ace;
            $ace->addFlyOn($this);
        }

        return $this;
    }

    public function removeAce(Aces $ace): self
    {
        if ($this->aces->removeElement($ace)) {
            $ace->removeFlyOn($this);
        }

        return $this;
    }

    public function __toString():string
    {
        return $this->model;
    }

}
