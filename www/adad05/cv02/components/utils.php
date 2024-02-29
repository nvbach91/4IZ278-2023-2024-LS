<?php
function getAgeFromDate($birthdayDate)
{
    try {
        $date = new DateTime($birthdayDate);
        $now = new DateTime();
        $interval = $now->diff($date);
        return "Person born in $birthdayDate is $interval->y years old today";
    } catch (Exception $e) {
        echo "Wrong input format: use the \"year-month-date\" pattern!";
    }
}
