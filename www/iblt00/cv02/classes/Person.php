<?php

class Person
{
    public function __construct(
        public $dob,
        public $avatar,
        public $company,
        public $email,
        public $forHire,
        public $name,
        public $position,
        public $street,
        public $streetNumber1,
        public $streetNumber2,
        public $surname,
        public $tel,
        public $town,
        public $webPage,
    ) {
    }

    public function getStreetNumber()
    {
        return "$this->streetNumber1 / $this->streetNumber2";
    }

    public function getAvailability()
    {
        return $this->forHire ? 'Hire Now' : '';
    }

    public function getFullName()
    {
        return "$this->name $this->surname";
    }
}
