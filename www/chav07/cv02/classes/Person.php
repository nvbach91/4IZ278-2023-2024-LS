<?php

class Person{

    public function __construct(
        public string $firstName,
        public string $lastName,
        public DateTime $dateOfBirth,
        public string $position,
        public string $companyName,
        public Address $address,
        public string $telephone,
        public string $email,
        public string $website,
        public bool $isLookingForJob,
        public string $image_url
    )
    {
        
    }

    public function getCurrentAge(): int {
        $now = new DateTime("now");
        $difference = $this->dateOfBirth->diff($now);

        return $difference->y;
    }
    public function isLookingForJobToString(): string{
        return $this->isLookingForJob ? "Now ready to get hired!" : "Not looking for a job";
    }
    public function getFullName(): string {
        return $this->firstName . " " . $this->lastName;
    }
}
?>