<?php

class Person {
    public function __construct(
    public string $avatar, 
    public string $firstName, 
    public string $lastName,
    public string $birthDate, 
    public string $job, 
    public string $company, 
    public string $street, 
    public int $streetNum, 
    public int $orientationNumber, 
    public string $city, 
    public string $phone, 
    public string $email, 
    public string $website, 
    public bool $lookingForJob) {}

    function getAddress(Person $person): string {
        return $person->street . ' ' . (string)$person->streetNum.'/'.(string)$person->orientationNumber . ', ' . $person->city;
    }
    function getFullName(Person $person): string {
        return $person->lastName ." ". $person->firstName;
    }
    function getAge(Person $person) {
        $birthY = (int)explode('.', $person->birthDate)[2];
        $today = (int)date('Y');
        return $today-$birthY;
    }
    

}