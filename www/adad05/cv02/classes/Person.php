<?php
class Person
{
    public function __construct(
        public $name,
        public $lastName,
        public $age,
        public $isMarried,
        public $occupation,
        public $companyName,
        public $street,
        public $streetCode,
        public $sector,
        public $city,
        public $number,
        public $email,
        public $website,
        public $lookingForJob,
        public $logo,
        public $logoBack,
        public $businessCardBackgroudImageUrl
    ) {
    }

    public function getAddress()
    {
        return "This persons's adress is $this->street $this->streetCode, $this->city";
    }

    public function getFullName()
    {
        return "This persons's full name name is $this->name $this->lastName";
    }

    public function getAge()
    {
        return "$this->name is $this->age years old!";
    }
}
