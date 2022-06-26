<?php

namespace App\Entity;

use App\Repository\PlacesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlacesRepository::class)
 */
class Places
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
    private $place_name;

    /**
     * @ORM\OneToMany(targetEntity=Battles::class, mappedBy="battle_place", orphanRemoval=true)
     */
    private $battles;

    public function __construct()
    {
        $this->battles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaceName(): ?string
    {
        return $this->place_name;
    }

    public function setPlaceName(string $place_name): self
    {
        $this->place_name = $place_name;

        return $this;
    }

    /**
     * @return Collection<int, Battles>
     */
    public function getBattles(): Collection
    {
        return $this->battles;
    }

    public function addBattle(Battles $battle): self
    {
        if (!$this->battles->contains($battle)) {
            $this->battles[] = $battle;
            $battle->setBattlePlace($this);
        }

        return $this;
    }

    public function removeBattle(Battles $battle): self
    {
        if ($this->battles->removeElement($battle)) {
            // set the owning side to null (unless already changed)
            if ($battle->getBattlePlace() === $this) {
                $battle->setBattlePlace(null);
            }
        }

        return $this;
    }

    public function __toString():string
    {
        return $this->place_name;
    }
}
