<?php

$first_name = "Jakub";
$last_name = "David";
$birth_date = "2000-12-18";
$profession = "CEO";
$company = "Resonect Technology s.r.o.";
$address = "Korunní 2569/108, Vinohrady, Praha 10";
$phone = "+420 739 755 098";
$email = "jakub.david@resonect.cz";
$website = "www.resonect.cz";
$open_to_work = false;
$logo = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUq9BqXPjqrt7YYBvfNHcWa88qKLbZcstXOh_mcnNiSA&s";


class Person {
    public function __construct(
        public $first_name,
        public $last_name,
        public $birth_date,
        public $profession,
        public $company,
        public $address,
        public $phone,
        public $email,
        public $website,
        public $open_to_work,
        public $logo)
    {}

    public function getFullName() {
        return "$this->first_name $this->last_name";
    }

    public function getAge() {
        $birth_date_object = new DateTime($this->birth_date);
        $current_date_object = new DateTime('now');
        $age_difference = $current_date_object->diff($birth_date_object); //Method to calculate the difference between two dates
        
        return $age_difference->y; //Get the difference in years            
    }
}


?>