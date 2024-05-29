<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $sold_at = null;

    #[ORM\ManyToOne(inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entrance $entrance = null;

    /**
     * @var Collection<int, FootballMatch>
     */
    #[ORM\ManyToMany(targetEntity: FootballMatch::class, inversedBy: 'tickets')]
    private Collection $matches;

    #[ORM\Column]
    private ?bool $is_multi = null;

    public function __construct()
    {
        $this->matches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSoldAt(): ?\DateTimeImmutable
    {
        return $this->sold_at;
    }

    public function setSoldAt(\DateTimeImmutable $sold_at): static
    {
        $this->sold_at = $sold_at;

        return $this;
    }

    public function getEntrance(): ?Entrance
    {
        return $this->entrance;
    }

    public function setEntrance(?Entrance $entrance): static
    {
        $this->entrance = $entrance;

        return $this;
    }

    /**
     * @return Collection<int, FootballMatch>
     */
    public function getMatches(): Collection
    {
        return $this->matches;
    }

    public function addMatch(FootballMatch $match): static
    {
        if (!$this->matches->contains($match)) {
            $this->matches->add($match);
        }

        return $this;
    }

    public function removeMatch(FootballMatch $match): static
    {
        $this->matches->removeElement($match);

        return $this;
    }

    public function isMulti(): ?bool
    {
        return $this->is_multi;
    }

    public function setMulti(bool $is_multi): static
    {
        $this->is_multi = $is_multi;

        return $this;
    }
}
