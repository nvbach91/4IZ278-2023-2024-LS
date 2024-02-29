<?php

class Person
{
    public function __construct(
        public $avatar,
        public $firstName,
        public $lastName,
        public $title,
        public $company,
        public $phone,
        public $email,
        public $website,
        public $available,
        public $street,
        public $propertyNumber,
        public $orientationNumber,
        public $city,
        public $bankBalance,
        public $currency,
    )
    {
    }

    public function getAddress()
    {
        return "$this->street $this->propertyNumber/$this->orientationNumber, $this->city";
    }

    public function getBankBalance()
    {
        return number_format($this->bankBalance, 2, ',', ' ') . " $this->currency";
    }

    public function getAvailability()
    {
        return $this->available ? 'Now available for contracts' : 'Not available for contracts';
    }

}

