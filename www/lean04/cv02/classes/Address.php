<?php

class Address
{
    public function __construct(private $street, private $streetNumber, private $city, private $zip, private $country)
    {
        $this->street = $street;
        $this->streetNumber = $streetNumber;
        $this->city = $city;
        $this->zip = $zip;
        $this->country = $country;
    }

    public function getFullAddress()
    {
        return "$this->street $this->streetNumber, $this->zip $this->city, $this->country";
    }
}
