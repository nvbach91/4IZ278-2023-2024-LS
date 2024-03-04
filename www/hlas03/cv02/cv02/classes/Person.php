<?php
class Person{
    public function __construct(
        public $backgrounPhoto,
        public $logo,
        public $firstnName,
        public $lastName,
        public $age,
        public $job,
        public $companyName,
        public $street,
        public $descriptiveNum,
        public $postalCode,
        public $city,
        public $phoneNum,
        public $email,
        public $website,
        public $lookingForJob,
    )
    {}

    public function getAddress() {
        return "$this->street $this->descriptiveNum";
    }


    public function getCity() {
        return "$this->city  $this->postalCode";
    }

    public function getFullName() {
        return "$this->firstnName  $this->lastName";
    }

}
?>
