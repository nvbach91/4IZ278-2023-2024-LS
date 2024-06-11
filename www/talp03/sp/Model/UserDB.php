<?php

require_once 'Database.php';

class UserDB extends Database {
    
    public function findAll() {
        $statement = $this->pdo->prepare('SELECT * FROM users');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPrivilege($email) {
        $statement = $this->pdo->prepare('SELECT privilege FROM users WHERE email = :email');
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findUserByEmail($email) {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findUserIDByEmail($email) {
        $statement = $this->pdo->prepare('SELECT user_id FROM users WHERE email = :email');
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function changePrivilege($userId, $privilege) {
        $statement = $this->pdo->prepare('UPDATE users SET privilege = :privilege WHERE user_id = :user_id');
        $statement->bindValue(':privilege', $privilege, PDO::PARAM_INT);
        $statement->bindValue(':user_id', $userId, PDO::PARAM_INT);
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