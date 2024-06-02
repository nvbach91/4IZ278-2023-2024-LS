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

    public function updateUser($userId, $first_name, $last_name, $email, $phone) {
        $sql = "UPDATE $this->tableName SET first_name = :first_name, last_name = :last_name, email = :email, phone = :phone WHERE user_id = :user_id";
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'user_id' => $userId
        ]);
    }

    public function updatePassword($userId, $new_password_hash) {
        $sql = "UPDATE $this->tableName SET password_hash = :password_hash WHERE user_id = :user_id";
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            'password_hash' => $new_password_hash,
            'user_id' => $userId
        ]);
    }

    public function findById($user_id) {
        return $this->findBy('user_id', $user_id, false);
    }

    public function findByEmail($email) {
        return $this->findBy('email', $email, false);
    }

    public function findByPhone($phone) {
        return $this->findBy('phone', $phone, false);
    }

    public function delete($user_id) {
        $sql = "DELETE FROM $this->tableName WHERE user_id = :user_id";
        $statement = $this->pdo->prepare($sql);
        return $statement->execute(['user_id' => $user_id]);
    }
}

?>
