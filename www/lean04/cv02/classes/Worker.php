<?php

class Worker extends Person
{
    public function __construct(
        private $firstName,
        private $lastName,
        private $dateOfBirth,
        private $jobTitle,
        private $company,
        private $phone,
        private $email,
        private $lookingForJob = false
    ) {
        parent::__construct($firstName, $lastName, $dateOfBirth, $lookingForJob);
        $this->jobTitle = $jobTitle;
        $this->company = $company;
        $this->phone = $phone;
        $this->email = $email;
        $this->lookingForJob = $lookingForJob;
    }

    public function getFullName()
    {
        return parent::getFullName();
    }

    public function getDateOfBirth()
    {
        return parent::getDateOfBirth();
    }

    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function isLookingForJob()
    {
        return $this->lookingForJob;
    }
}
