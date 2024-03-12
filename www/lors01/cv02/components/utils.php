<?php


function getAge($birthDate) {
    $dateOfBirth = new DateTime($birthDate);
    $today = new DateTime('today');
    return $dateOfBirth->diff($today)->y;
}

?>
