<?php

class AddressValidator {
    private $errors = [];

    public function validate($street, $city, $zip_code, $country) {
        $this->errors = [];

        if (empty($street) || empty($city) || empty($zip_code) || empty($country)) {
            $this->errors[] = "Všechny položky musí být vyplněny.";
        }

        return $this->errors;
    }
}
?>
