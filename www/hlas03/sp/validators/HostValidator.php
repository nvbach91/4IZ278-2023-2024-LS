<?php

require_once __DIR__ . '/BaseUserValidator.php';
require_once __DIR__ . '/../db/UsersDB.php';

class HostValidator extends BaseUserValidator {
    private $userDB;

    public function __construct() {
        $this->userDB = new UsersDB();
    }

    public function validateHost($first_name, $last_name, $email, $phone) {
        $this->errors = [];

        $this->validateRequiredFields([
            'Jméno' => $first_name,
            'Příjmení' => $last_name,
            'Email' => $email,
            'Telefonní číslo' => $phone
        ]);
        $this->validateEmailFormat($email);
        $this->validatePhoneFormat($phone);
        $this->validateEmailNotInUsers($email);

        return $this->errors;
    }

    private function validateEmailNotInUsers($email) {
        $existingUserByEmail = $this->userDB->findByEmail($email);
        if ($existingUserByEmail) {
            $this->errors[] = "Tento email již je registrován. Přihlaste se prosím.";
        }
    }
}

?>
