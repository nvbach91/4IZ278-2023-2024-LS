<?php
class Person {
    public function __construct(
        public $lastName,
        public $firstName,
        public $occupation,
        public $company, // name, street, houseNumber1, houseNumber2, city
        public $contact, // phone, email, web
        public $lookingForWork,
        public $birthDate
    ) {}
}
?>