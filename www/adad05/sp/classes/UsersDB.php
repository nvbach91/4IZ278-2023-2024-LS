<?php

require_once 'Database.php';

class UsersDB extends Database
{
    public function find()
    {
        $results = $this->runQuery("SELECT * FROM users", []);
        return $results;
    }

    public function findByEmail($email)
    {
        $results = $this->runQuery("SELECT * FROM users WHERE email like :email", ['email' => $email]);
        return $results;
    }

    public function createUser($name, $email, $password)
    {
        $results = $this->runQuery("INSERT INTO users (name, email, password, privilege) values ('$name', '$email', '$password', 1) ", []);
        return $results;
    }

    public function updateUser($email, $privilege)
    {
        $results = $this->runQuery("UPDATE users SET privilege = $privilege WHERE email like '$email'", []);
        return $results;
    }
}