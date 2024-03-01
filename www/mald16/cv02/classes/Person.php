<?php
class Person {
    public function __construct(
        public $avatar,
        public $name,
        public $surname,
        public $birthday,
        public $job,
        public $company,
        public $street,
        public $streetNum1,
        public $streetNum2,
        public $city,
        public $phone,
        public $email,
        public $web,
        public $lookingForJob
    ) {
    }

    public function getFullName() {
        return "$this->name $this->surname";
    }

    public function getAge() {
        return calculateAge($this->birthday);
    }

    public function getFullAddress() {
        return "$this->street $this->streetNum1/$this->streetNum2 $this->city";
    }

    public function available() {
        return $this->lookingForJob ? "✅ Hledám práci" : "❌ Nehledám práci";
    }
}
