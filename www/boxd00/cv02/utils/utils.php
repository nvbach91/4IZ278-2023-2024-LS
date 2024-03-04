<?php
function getAge($person) {
    $birthDate = $person->birthDate;
    $today = new DateTime(date("Y-m-d"));
    $diff = $today->diff(new DateTime($birthDate));
    return $diff->y;
}

function getAddress($person) {
    return $person->company["street"] . " " . $person->company["houseNumber1"] . "/" . $person->company["houseNumber2"] . ", " . $person->company["city"];
}

function getFullName($person) {
    return "$person->firstName $person->lastName";
}
?>