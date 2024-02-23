<?php

include "./utils/functions.php";

class Person
{
  public function __construct(
    public string $name,
    public string $lastName,
    public string $birthDate,
    public string $currentJob,
    public string $companyName,
    public string $adress,
    public int $houseNumber,
    public int $houseNumber2,
    public string $city,
    public string $phone,
    public string $email,
    public string $portfolio,
    public bool $isLookingForJob
  ) {
  }

  public function getAdress()
  {
    return getAdress($this->adress, $this->houseNumber, $this->houseNumber2);
  }

  public function getFullName()
  {
    return getFullName($this->name, $this->lastName);
  }

  public function getAge()
  {
    return getAge($this->birthDate);
  }
}
