<?php

require_once './utils/personalInfo.php';

class Person
{

  public function __construct(
    private $avatar,
    private $scareCrow,
    private $lastName,
    private $firstName,
    private $birthDate,
    private $job,
    private $company,
    private $street,
    private $houseNumber,
    private $orientationNumber,
    private $city,
    private $phone,
    private $email,
    private $web,
    private $lookingForJob,
    private $accountNumbers
  ) {
  }

  public function getAddress()
  {
    return getAddress($this->street, $this->houseNumber, $this->orientationNumber, $this->city);
  }

  public function getFullName()
  {
    return $this->firstName . ' ' . $this->lastName;
  }

  public function getPhone()
  {
    return $this->phone;
  }

  public function getAge(): int
  {
    return getAge($this->birthDate);
  }

  public function getFullAge()
  {
    if ($this->getFullName() === 'Master Yoda') {
      return $this->getAge() . " years old I am (damn).";
    }

    return "I am " . $this->getAge() . " years old.";
  }

  public function getAvatar()
  {
    return $this->avatar;
  }

  public function getScareCrow()
  {
    return $this->scareCrow;
  }

  public function getJob()
  {
    return $this->job;
  }

  public function getCompany()
  {
    return $this->company;
  }

  public function getFullJob()
  {
    return getFullJob($this->job, $this->company);
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getWeb()
  {
    return $this->web;
  }

  public function getLookingForJob()
  {
    return $this->lookingForJob;
  }

  public function getJobStatus()
  {
    if ($this->getFullName() === 'Master Yoda') {
      return  $this->lookingForJob ? 'Currently looking for a job I am' : 'Not looking for a job unfortunately I am!';
    }

    return $this->lookingForJob ? 'Currently looking for a job' : 'Unfortunately not looking for a job!';
  }

  public function getAccountNumbers()
  {
    return $this->accountNumbers;
  }
}
