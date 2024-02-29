<?php
class Person {
    public function __construct(
        public $logo,
        public $firstName,
        public $lastName,
        public $title,
        public $companyName,
        public $phone,
        public $email,
        public $website,
        public $avaible,
        public $companyStreet,
        public $companyPropertyNumber,
        public $companyOrientationNumber,
        public $companyCity,
        public $birthdate,
    ) {}

    public function getFullName() {
        return "$this->firstName $this->lastName";
    }

    public function getJobMessage() {
        return $this->avaible ? 'momentálně shaním práci' : 'momentálně neshaním práci';
    }

    public function getAddress() {
        return "$this->companyStreet $this->companyPropertyNumber, $this->companyCity $this->companyOrientationNumber";
    }
    
    public function getAge() {
        $today = new DateTime(date('Y-m-d'));
        $difference = $today->diff($this->birthdate);
        return $difference->y;
    }
}
