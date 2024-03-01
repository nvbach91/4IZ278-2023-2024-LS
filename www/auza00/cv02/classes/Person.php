<?php
    class Person{
        public function __construct(
            public $avatar,                  // datatype string
            public $firstName,
            public $lastName,
            public $title,
            public $company,
            public $phone,
            public $email,
            public $website,
            public $available,                         // datatype boolean
            public $street,
            public $propertyNumber,                       // datatype integer number
            public $orientationNumber,
            public $city,
            public $bankBalance,                 // datatype double/float
            public $currency,
            public $yearBorn,
            public $yearCurrent
        ){}

    public function getAddress(){
        return "$this->street $this->propertyNumber/$this->orientationNumber, $this->city";
    }

    public function getFullName(){
        return "$this->firstName $this->lastName";
    }

    public function getAge(){
        return "$this->yearCurrent"-"$this->yearBorn";
    }
}
?>