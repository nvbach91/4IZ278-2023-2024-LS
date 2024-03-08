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

    public function getAge($person) {
        $birthDate = $person->birthDate;
        $today = new DateTime(date("Y-m-d"));
        $diff = $today->diff(new DateTime($birthDate));
        return $diff->y;
    }
    
    public function getAddress($person) {
        return $person->company["street"] . " " . $person->company["houseNumber1"] . "/" . $person->company["houseNumber2"] . ", " . $person->company["city"];
    }
    
    public function getFullName($person) {
        return "$person->firstName $person->lastName";
    }
}
?>