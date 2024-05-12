<?php

namespace App\Entity;

use App\Repository\FootballMatchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FootballMatchRepository::class)]
class FootballMatch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $played_at = null;

    #[ORM\ManyToOne(inversedBy: 'footballMatches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $created_by = null;

    #[ORM\Column]
    private ?float $full_price = null;

    #[ORM\Column]
    private ?float $child_price = null;

    /**
     * @var Collection<int, Ticket>
     */
    #[ORM\OneToMany(mappedBy: 'FootballMatch', targetEntity: Ticket::class)]
    private Collection $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getPlayedAt(): ?\DateTimeImmutable
    {
        return $this->played_at;
    }

    public function setPlayedAt(\DateTimeImmutable $played_at): static
    {
        $this->played_at = $played_at;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->created_by;
    }

    public function setCreatedBy(?User $created_by): static
    {
        $this->created_by = $created_by;

        return $this;
    }

    public function getFullPrice(): ?float
    {
        return $this->full_price;
    }

    public function setFullPrice(float $full_price): static
    {
        $this->full_price = $full_price;

        return $this;
    }

    public function getChildPrice(): ?float
    {
        return $this->child_price;
    }

    public function setChildPrice(float $child_price): static
    {
        $this->child_price = $child_price;

        return $this;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): static
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets->add($ticket);
            $ticket->setFootballMatch($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): static
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getFootballMatch() === $this) {
                $ticket->setFootballMatch(null);
            }
        }

        return $this;
    }
}
