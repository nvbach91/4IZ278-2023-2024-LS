<?php

class BaseUserValidator {
    protected $errors = [];

    protected function validateRequiredFields($fields) {
        foreach ($fields as $field => $value) {
            if (empty($value)) {
                $this->errors[] = "Pole $field musí být vyplněno.";
            }
        }
    }

    protected function validateEmailFormat($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Neplatný formát emailu.";
        }
    }

    protected function validatePhoneFormat($phone) {
        if (!preg_match('/^(\+420\s?)?(\d{3}\s?\d{3}\s?\d{3})$/', $phone)) {
            $this->errors[] = "Neplatný formát telefonního čísla.";
        }
    }

    public function getErrors() {
        return $this->errors;
    }

    public function validateAndFormatPhone($phone) {
        // Odstranit mezery
        $phone = preg_replace('/\s+/', '', $phone);
        // Přidat předvolbu +420, pokud není uvedena
        if (strpos($phone, '+420') !== 0) {
            $phone = '+420' . $phone;
        }
        return $phone;
    }
}
?>
