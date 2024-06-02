<?php

require_once __DIR__ . '/../db/UsersDB.php';

class UserValidator {
    private $userDB;
    private $errors = [];

    public function __construct() {
        $this->userDB = new UsersDB();
    }

    public function validateRegistration($first_name, $last_name, $email, $phone, $password, $confirm_password) {
        $this->errors = [];

        $this->validateRequiredFields($first_name, $last_name, $email, $phone);
        $this->validateEmailFormat($email);
        $this->validatePhoneFormat($phone);
        $this->validateUniqueEmail($email);
        $this->validateUniquePhone($phone);
        $this->validatePasswords($password, $confirm_password);

        return $this->errors;
    }

    public function validateProfileEdit($first_name, $last_name, $email, $phone, $userId, $current_password) {
        $this->errors = [];

        $this->validateRequiredFields($first_name, $last_name, $email, $phone);
        $this->validateEmailFormat($email);
        $this->validatePhoneFormat($phone);
        $this->validateUniqueEmail($email, $userId);
        $this->validateUniquePhone($phone, $userId);
        $this->validateCurrentPassword($userId, $current_password);

        return $this->errors;
    }

    public function validatePasswordChange($userId, $current_password, $new_password, $confirm_password) {
        $this->errors = [];

        $this->validateCurrentPassword($userId, $current_password);
        $this->validatePasswords($new_password, $confirm_password);

        return $this->errors;
    }

    public function validateLogin($email, $password) {
        $this->errors = [];

        $user = $this->userDB->findByEmail($email);
        if ($user) {
            if (!password_verify($password, $user['password_hash'])) {
                $this->errors[] = "Incorrect password.";
            } elseif (!$user['is_active']) {
                $this->errors[] = "This account is inactive. Please contact support.";
            }
        } else {
            $this->errors[] = "Email not found.";
        }

        return $this->errors;
    }

    private function validateRequiredFields($first_name, $last_name, $email, $phone) {
        if (empty($first_name) || empty($last_name) || empty($email) || empty($phone)) {
            $this->errors[] = "Všechny položky musí být vyplněny.";
        }
    }

    private function validateEmailFormat($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Neplatný formát emailu.";
        }
    }

    private function validatePhoneFormat($phone) {
        if (!preg_match('/^\+?[1-9]\d{1,14}$/', $phone)) {
            $this->errors[] = "Neplatný formát telefonního čísla.";
        }
    }

    private function validateUniqueEmail($email, $userId = null) {
        $existingUserByEmail = $this->userDB->findByEmail($email);
        if ($existingUserByEmail && $existingUserByEmail['user_id'] != $userId) {
            $this->errors[] = "Email již byl zaregistrován.";
        }
    }

    private function validateUniquePhone($phone, $userId = null) {
        $existingUserByPhone = $this->userDB->findByPhone($phone);
        if ($existingUserByPhone && $existingUserByPhone['user_id'] != $userId) {
            $this->errors[] = "Telefonní číslo již bylo zaregistrováno.";
        }
    }

    private function validateCurrentPassword($userId, $current_password) {
        $user = $this->userDB->findById($userId);
        if (!password_verify($current_password, $user['password_hash'])) {
            $this->errors[] = "Nesprávné heslo.";
        }
    }

    private function validatePasswords($password, $confirm_password) {
        if ($password !== $confirm_password) {
            $this->errors[] = "Hesla se neshodují.";
        }

        if (strlen($password) < 5) {
            $this->errors[] = "Heslo musí být dlouhé alespoň 5 znaků.";
        }
    }
}

?>
