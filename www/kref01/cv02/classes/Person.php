<?php
require './components/utils.php';

class Person {
    public function __construct(
        public $avatar,
        public $cardTemplateFront,
        public $cardTemplateBack,
        public $firstName,
        public $middleName,
        public $lastName,
        public $alias,
        public $title,
        public $company,
        public $street,
        public $propertyNumber,
        public $orientationNumber,
        public $city,
        public $email,
        public $phone,
        public $available,
        public $birthYear,
        public $nowYear,
    ) {}

    public function getAddress() {
        return "$this->street $this->propertyNumber/$this->orientationNumber, $this->city";
    }
    public function getFullName() {
        return "$this->firstName $this->middleName $this->lastName";
    }
    public function getAge() {
        return countAge($this->birthYear, $this->nowYear);
    }
}

?>