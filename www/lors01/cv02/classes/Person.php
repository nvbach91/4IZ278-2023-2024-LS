<?php

class Person {
    public $avatar;
    public $firstName;
    public $lastName;
    public $birthDate;
    public $jobTitle;
    public $companyName;
    public $street;
    public $houseNumber;
    public $orientationNumber;
    public $city;
    public $phone;
    public $isMarried;
    public $email;
    public $website;
    public $isLookingForJob;

    public function __construct($avatar, $firstName, $lastName, $birthDate, $jobTitle, $companyName, $street, $houseNumber, $orientationNumber, $city, $phone, $isMarried, $email, $website, $isLookingForJob) {
        $this->avatar = $avatar;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
        $this->jobTitle = $jobTitle;
        $this->companyName = $companyName;
        $this->street = $street;
        $this->houseNumber = $houseNumber;
        $this->orientationNumber = $orientationNumber;
        $this->city = $city;
        $this->phone = $phone;
        $this->isMarried = $isMarried;
        $this->email = $email;
        $this->website = $website;
        $this->isLookingForJob = $isLookingForJob;
    }

    public function getFullName() {
        return $this->firstName . " " . $this->lastName;
    }

    public function getAddress() {
        return $this->street . " " . $this->houseNumber . "/" . $this->orientationNumber . ", " . $this->city;
    }

    // public function getAge() {
    //     $birthDate = new DateTime($this->birthDate);
    //     $currentDate = new DateTime();
    //     return $currentDate->diff($birthDate)->y;
    // }
}
?>
