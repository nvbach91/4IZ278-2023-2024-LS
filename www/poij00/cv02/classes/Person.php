<?php 

class Person {
    public function __construct(
        public $avatar,
        public $firstName,
        public $lastName,
        public $dateOfBirth,
        public $company,
        public $position,
        public $buildingNumber,
        public $street,
        public $city,
        public $phone,
        public $email,
        public $web,
        public $contracts,

    ) {}

    public function getFullName() {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getAge() {
        $date = new DateTime($this->dateOfBirth);
        $today = new DateTime();
        $age = date_diff($date, $today);
        return $age -> y;
    }

    public function getAddress() {
        return "$this->buildingNumber" . " " . "$this->street" . " " . "$this->city";
    }

    public function getNewContracts () {
        if($this -> contracts) {
            return 'Not available for contracts now';
        } else {
            return 'Available for contracts now';
        }
    }

}

?>