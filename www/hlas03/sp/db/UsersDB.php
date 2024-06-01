<?php

require_once __DIR__ . '/Database.php';

class UsersDB extends Database {
    protected $tableName = 'users';

    public function create($first_name, $last_name, $email, $phone, $password) {
        $sql = "INSERT INTO $this->tableName (first_name, last_name, email, phone, password_hash) VALUES (:first_name, :last_name, :email, :phone, :password_hash)";
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    public function findByEmail($email) {
        return $this->findBy('email', $email, false);
    }

    public function findByPhone($phone) {
        return $this->findBy('phone', $phone, false);
    }
}

?>
