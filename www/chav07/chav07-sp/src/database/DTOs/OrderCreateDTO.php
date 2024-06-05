<?php

namespace Vilem\BookBookGo\database\DTOs;

class OrderCreateDTO
{
    public int $userId;
    public bool $paid;
    public bool $delivered;
    public string $street;
    public string $city;
    public string $postalCode;
    public string $phone;

    function __construct(int $userId, bool $paid, bool $delivered, string $street, string $city, string $postalCode, string $phone)
    {
        $this->userId = $userId;
        $this->paid = $paid;
        $this->delivered = $delivered;
        $this->street = $street;
        $this->city = $city;
        $this->postalCode = $postalCode;
        $this->phone = $phone;
    }
}