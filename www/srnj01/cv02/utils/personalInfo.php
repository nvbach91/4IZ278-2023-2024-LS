<?php

function getAddress($street, $houseNumber, $orientationNumber, $city)
{
  return $street . ' ' . $houseNumber . '/' . $orientationNumber . ', ' . $city;
}

function getAge($birthDate)
{
  $birthDate = new DateTime($birthDate);
  $now = new DateTime();
  $age = $now->diff($birthDate)->y;
  return $age;
}

function getFullJob($job, $company)
{
  return $job . ' at ' . $company;
}
