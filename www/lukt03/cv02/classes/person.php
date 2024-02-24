<?php

require './classes/utils.php';

class Person {
    public function __construct(
        public $avatar,
        public $firstName,
        public $lastName,
        public $born,
        public $job,
        public $company,
        public $street,
        public $houseNumber,
        public $orientationNumber,
        public $city,
        public $phone,
        public $email,
        public $website,
        public $lookingForJob
    ) {}

    public function getFullName() {
        return "$this->firstName $this->lastName";
    }

    public function getAddress() {
        return "$this->street $this->houseNumber" .
            ($this->orientationNumber ? "/$this->orientationNumber" : "") .
            ", $this->city";
    }

    public function getAge() {
        return birthdayToAge($this->born);
    }

    public function getWebsiteUrl() {
        return "https://$this->website";
    }

    public function getLookingForJobText() {
        return $this->lookingForJob ? "Looking for a job" : "Not looking for a job";
    }
}