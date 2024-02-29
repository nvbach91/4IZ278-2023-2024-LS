<?php
class Person
{
    public function __construct(
        public $logo,
        public $backgroundImage,
        public $lastName,
        public $firstName,
        public $dateOfBirth,
        public $job,
        public $companyName,
        public $commandShips,
        public $streetName,
        public $streetNumber,
        public $evidenceNumber,
        public $city,
        public $phone,
        public $email,
        public $webURL,
        public $isLookingForJob
    ) {
    }

    // metoda
    public function getFullName()
    {
        return "$this->firstName $this->lastName";
    }

    public function getAge()
    {
        // substracting 340 years
        $dateOfBirthObject = new DateTime($this->dateOfBirth);
        $dateOfBirthObject->modify("-346 years");
        // current date
        $currentDate = date("Y-m-d");
        // calculating age
        $currentDateObject = new DateTime($currentDate);
        $age = $dateOfBirthObject->diff($currentDateObject)->y;
        return "$age";
    }

    public function getAddress()
    {
        return "$this->streetName $this->streetNumber / $this->evidenceNumber $this->city";
    }

    public function getJobStatus(){
        $isLookingForJobStatus = $this->isLookingForJob ? "Is" : "Not";
        return "$isLookingForJobStatus";
    }
}
