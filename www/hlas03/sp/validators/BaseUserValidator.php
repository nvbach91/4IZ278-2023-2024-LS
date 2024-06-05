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
        if (!preg_match('/^\+?[1-9]\d{1,14}$/', $phone)) {
            $this->errors[] = "Neplatný formát telefonního čísla.";
        }
    }

    public function getErrors() {
        return $this->errors;
    }
}
?>
