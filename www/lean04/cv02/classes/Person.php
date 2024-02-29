<?php

class Person
{
    public function __construct(private $firstName, private $lastName, private $dateOfBirth)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getFullName()
    {
        return "$this->firstName $this->lastName";
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth->format('d.m.Y');
    }

    public function getAge()
    {
        return $this->dateOfBirth->diff(new DateTimeImmutable())->y;
    }
}
