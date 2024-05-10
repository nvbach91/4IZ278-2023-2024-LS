<?php

require_once 'Database.php';

class UserDB extends Database {
    public function findAll() {
        $statement = $this->pdo->prepare('SELECT * FROM users');
        $statement->execute();
        return $statement->fetchAll();
    }

    public function changePrivilege($user_id, $privilege) {
        $statement = $this->pdo->prepare('UPDATE cv10_users SET privilege = :privilege WHERE user_id = :user_id');
        $statement->bindValue('privilege', $privilege, PDO::PARAM_INT);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function registerUser($registrationData) {
        $statement = $this->pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        $statement->execute(['name' => $registrationData['name'],
                             'email' => $registrationData['email'],
                             'password' => $registrationData['password']]);
    }
}

?>