<?php 

class Person {
    public function __construct(
        public $avatar,
        public $firstName,
        public $lastName,
        public $birthDate,
        public $position,
        public $companyName,
        public $adress,
        public $mobileNumber,
        public $email,
        public $lookingForJob
    ) {}
    
    public function getAge() {
        return date('Y') - $this->birthDate;
    }
}

?>