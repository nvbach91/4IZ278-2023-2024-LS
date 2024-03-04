<?php

class Address
{
    public function __construct(private $street, private $streetNumber, private $city, private $zip, private $country)
    {
    }

    public function getFullAddress()
    {
        return "$this->street $this->streetNumber, $this->zip $this->city, $this->country";
    }
}
