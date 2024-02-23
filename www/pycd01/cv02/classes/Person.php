<?php

class Person {
    public $avatar;
    public $firstName;
    public $lastName;
    public $birthDate;
    public $job;
    public $company;
    public $street;
    public $streetNum;
    public $orientationNumber;
    public $city;
    public $phone;
    public $email;
    public $website;
    public $lookingForJob;
    public function __construct(
    $avatar, 
    $firstName, 
    $lastName,
    $birthDate, 
    $job, 
    $company, 
    $street, 
    $streetNum, 
    $orientationNumber, 
    $city, 
    $phone, 
    $email, 
    $website, 
    $lookingForJob) {
        $this->avatar = $avatar;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
        $this->job = $job;
        $this->company = $company;
        $this->street = $street;
        $this->streetNum = $streetNum;
        $this->orientationNumber = $orientationNumber;
        $this->city = $city;
        $this->phone = $phone;
        $this->email = $email;
        $this->website = $website;
        $this->lookingForJob = $lookingForJob;
    }


    

}