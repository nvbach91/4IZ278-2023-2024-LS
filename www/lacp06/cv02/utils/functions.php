<?php

function getAdress($adress, $number1, $number2)
{
  return "$adress $number1/$number2";
}
function getFullName($name, $lastName)
{
  return "$name $lastName";
}

function getAge($birthDate)
{
  return date_diff(date_create($birthDate), date_create('today'))->y;
}
