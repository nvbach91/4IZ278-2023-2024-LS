<?php

namespace App\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

#[ODM\Document()]
class Brand
{
    #[ODM\Id()]
    private $id;

    #[ODM\Field(type: "string")]
    private string $name;

    #[ODM\EmbedMany(targetDocument: LoyaltyCard::class)]
    private Collection $loyaltyCards;

    #[ODM\ReferenceMany(targetDocument: User::class, inversedBy: "brands")]
    private Collection $users;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->loyaltyCards = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLoyaltyCards(): Collection
    {
        return $this->loyaltyCards;
    }

    public function addLoyaltyCard(LoyaltyCard $loyaltyCard): void
    {
        foreach ($this->loyaltyCards as $card) {
            if ($card->getEmail() === $loyaltyCard->getEmail()) {
                throw new \Exception("Karta s tímto emailem již existuje.");
            }
        }
        $loyaltyCard->setBrand($this);
        $this->loyaltyCards->add($loyaltyCard);
    }

    public function removeLoyaltyCard(string $email): void
    {
        foreach ($this->loyaltyCards as $key => $card) {
            if ($card->getEmail() === $email) {
                $this->loyaltyCards->remove($key);
                break;
            }
        }
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addBrand($this);
        }
        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeBrand($this);
        }
        return $this;
    }

    public function hasDuplicateCardIdentifier(string $cardIdentifier): bool
    {
        foreach ($this->loyaltyCards as $card) {
            if ($card->getCardIdentifier() === $cardIdentifier) {
                return true;
            }
        }
        return false;
    }
}
