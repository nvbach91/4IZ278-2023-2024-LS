<?php
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