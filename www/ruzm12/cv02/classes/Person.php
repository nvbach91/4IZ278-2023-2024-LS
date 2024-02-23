<?php

class Person
{
    public function __construct(private $firstName, private $lastName, private $dateOfBirth, private $position, private $company, private $street, private $streetNumber, private $orientionalNumber, private $city, private $phone, private $email, private $website, private $jobHunting, private $logo)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dateOfBirth = $dateOfBirth;
        $this->position = $position;
        $this->company = $company;
        $this->street = $street;
        $this->streetNumber = $streetNumber;
        $this->orientionalNumber = $orientionalNumber;
        $this->city = $city;
        $this->phone = $phone;
        $this->email = $email;
        $this->website = $website;
        $this->jobHunting = $jobHunting;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    public function getOrientionalNumber()
    {
        return $this->orientionalNumber;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function getJobHunting()
    {
        return $this->jobHunting;
    }

    public function getAge()
    {
        return date_diff(date_create($this->dateOfBirth), date_create('today'))->y;
    }

    public function getFullName()
    {
        return $this->firstName . " " . $this->lastName;
    }

    public function getFullAddress()
    {
        return $this->street . " " . $this->streetNumber . "/" . $this->orientionalNumber . ", " . $this->city;
    }

    public function getLogo()
    {
        return $this->logo;
    }
}
