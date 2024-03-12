<?php
class Person
{
    public function __construct(
        public $firstName,
        public $lastName,
        public $dateOfBirth,
        public $job,
        public $companyName,
        public $streetName,
        public $streetNumber,
        public $referenceNumber,
        public $city,
        public $phoneNumber,
        public $email,
        public $web,
        public $lookingForJob,
        public $businessCardBackground,
        public $avatarUrl
    )
    {
        
    }
    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }
    public function getFullAddress()
    {
        return $this->streetName . ' ' . $this->streetNumber . ', ' . $this->referenceNumber . $this->city;
    }
    public function getAge()
    {
        return date_diff(date_create($this->dateOfBirth), date_create('now'))->y;
    }
}
?>