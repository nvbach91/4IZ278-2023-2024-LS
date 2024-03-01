<?php
class Person
{
    public function __construct(
        public $avatar,
        public $firstName,
        public $lastName,
        public $birthYear,
        public $profession,
        public $street,
        public $city,
        public $phoneNumber,
        public $email,
        public $website,
        public $isLookingForJob,
        public $companyName,
        public $postNumber,
    ) {
    }
    public function getAdress()
    {
        return "Adress is: $this->street , $this->city ,  $this->postNumber";
    }
    public function getFullName()
    {
        return "Full name: $this->firstName $this->lastName";
    }
    public function getAge()
    {
        return "Age: " . (date('Y') - $this->birthYear);
    }
}
