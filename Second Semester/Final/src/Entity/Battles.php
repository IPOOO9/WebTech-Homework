<?php

namespace App\Entity;

use App\Repository\BattlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BattlesRepository::class)
 */
class Battles
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
    private $battle_name;

    /**
     * @ORM\ManyToOne(targetEntity=Places::class, inversedBy="battles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $battle_place;

    /**
     * @ORM\ManyToMany(targetEntity=Aces::class, inversedBy="battles")
     */
    private $battle_participants;

    public function __construct()
    {
        $this->battle_participants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBattleName(): ?string
    {
        return $this->battle_name;
    }

    public function setBattleName(string $battle_name): self
    {
        $this->battle_name = $battle_name;

        return $this;
    }

    public function getBattlePlace(): ?Places
    {
        return $this->battle_place;
    }

    public function setBattlePlace(?Places $battle_place): self
    {
        $this->battle_place = $battle_place;

        return $this;
    }

    /**
     * @return Collection<int, Aces>
     */
    public function getBattleParticipants(): Collection
    {
        return $this->battle_participants;
    }

    public function addBattleParticipant(Aces $battleParticipant): self
    {
        if (!$this->battle_participants->contains($battleParticipant)) {
            $this->battle_participants[] = $battleParticipant;
        }

        return $this;
    }

    public function removeBattleParticipant(Aces $battleParticipant): self
    {
        $this->battle_participants->removeElement($battleParticipant);

        return $this;
    }

    public function __toString():string
    {
        return $this->battle_name;
    }
}
