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

    #[ORM\ManyToOne(inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entrance $entrance = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $sold_at = null;

    #[ORM\ManyToOne(inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FootballMatch $FootballMatch = null;

    /**
     * @var Collection<int, Customer>
     */
    #[ORM\ManyToMany(targetEntity: Customer::class, mappedBy: 'tickets')]
    private Collection $customers;

    public function __construct()
    {
        $this->customers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSoldAt(): ?\DateTimeImmutable
    {
        return $this->sold_at;
    }

    public function setSoldAt(\DateTimeImmutable $sold_at): static
    {
        $this->sold_at = $sold_at;

        return $this;
    }

    public function getFootballMatch(): ?FootballMatch
    {
        return $this->FootballMatch;
    }

    public function setFootballMatch(?FootballMatch $FootballMatch): static
    {
        $this->FootballMatch = $FootballMatch;

        return $this;
    }

    /**
     * @return Collection<int, Customer>
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    public function addCustomer(Customer $customer): static
    {
        if (!$this->customers->contains($customer)) {
            $this->customers->add($customer);
            $customer->addTicket($this);
        }

        return $this;
    }

    public function removeCustomer(Customer $customer): static
    {
        if ($this->customers->removeElement($customer)) {
            $customer->removeTicket($this);
        }

        return $this;
    }
}
