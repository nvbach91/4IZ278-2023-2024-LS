<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\Types\Type;
use Symfony\Component\Validator\Constraints as Assert;

#[ODM\Document(collection: "new_card", indexes: [
    new ODM\Index(keys: ["email" => "asc"], options: ["unique" => true]),
    new ODM\Index(keys: ["cardIdentifier" => "asc"], options: ["unique" => true])
])]
class LoyaltyCard
{
    #[ODM\Id]
    private $id;

    #[ODM\Field(type: Type::STRING)]
    #[Assert\NotBlank]
    private string $customerName;

    #[ODM\Field(type: Type::STRING)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private string $email;

    #[ODM\Field(type: Type::STRING)]
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: "/^\+?[0-9]{7,15}$/",
        message: "Neplatné telefonní číslo."
    )]
    private string $phoneNumber;

    #[ODM\Field(type: Type::STRING)]
    #[Assert\NotBlank]
    private string $cardIdentifier;

    #[ODM\ReferenceOne(targetDocument: Brand::class)]
    private ?Brand $brand = null;

    public function __construct(string $customerName, string $email, string $phoneNumber, ?string $cardIdentifier = null)
    {
        $this->customerName = $customerName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->cardIdentifier = $cardIdentifier ?: $this->generateCardIdentifier();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    public function getCardIdentifier(): string
    {
        return $this->cardIdentifier;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setCustomerName(string $customerName): void
    {
        $this->customerName = $customerName;
    }

    public function setCardIdentifier(string $cardIdentifier): void
    {
        $this->cardIdentifier = $cardIdentifier;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(Brand $brand): void
    {
        $this->brand = $brand;
    }

    private function generateCardIdentifier(): string
    {
        return bin2hex(random_bytes(8));
    }
}
