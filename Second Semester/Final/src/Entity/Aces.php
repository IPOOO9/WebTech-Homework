<?php

namespace App\Entity;

use App\Repository\AcesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AcesRepository::class)
 */
class Aces
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
    private $ace_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $callsign;

    /**
     * @ORM\ManyToMany(targetEntity=Aircraft::class, inversedBy="aces")
     */
    private $fly_on;

    /**
     * @ORM\ManyToMany(targetEntity=Battles::class, mappedBy="battle_participants")
     */
    private $battles;

    public function __construct()
    {
        $this->fly_on = new ArrayCollection();
        $this->battles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAceName(): ?string
    {
        return $this->ace_name;
    }

    public function setAceName(string $ace_name): self
    {
        $this->ace_name = $ace_name;

        return $this;
    }

    public function getCallsign(): ?string
    {
        return $this->callsign;
    }

    public function setCallsign(string $callsign): self
    {
        $this->callsign = $callsign;

        return $this;
    }

    /**
     * @return Collection<int, Aircraft>
     */
    public function getFlyOn(): Collection
    {
        return $this->fly_on;
    }

    public function addFlyOn(Aircraft $flyOn): self
    {
        if (!$this->fly_on->contains($flyOn)) {
            $this->fly_on[] = $flyOn;
        }

        return $this;
    }

    public function removeFlyOn(Aircraft $flyOn): self
    {
        $this->fly_on->removeElement($flyOn);

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
            $battle->addBattleParticipant($this);
        }

        return $this;
    }

    public function removeBattle(Battles $battle): self
    {
        if ($this->battles->removeElement($battle)) {
            $battle->removeBattleParticipant($this);
        }

        return $this;
    }

    public function __toString():string
    {
        return $this->callsign;
    }
}
