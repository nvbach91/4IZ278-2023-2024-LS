<?php

class Person {
    

    public function __construct(
        public $name,
        public $surname,
        public $dob,
        public $position,
        public $company,
        public $street,
        public $house_number,
        public $apt_number,
        public $city,
        public $phone,
        public $email,
        public $website,
        public $avatarLink,
        public $jobLookout
    ) {}

    public function getFullName() {
        return $this->name . ' ' . $this->surname;
    }

    public function getAge() {
        $date = new DateTime($this->dob);
        $today = new DateTime();
        $age = date_diff($date, $today);
        return $age -> y;
    }

    public function getAddress() {
        return "$this->house_number" . " " . "$this->street" . " " . "$this->city";
    }
}

?>