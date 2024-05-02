<?php

require_once 'Database.php';

class UsersDB extends Database
{
    public function find()
    {
        $results = $this->runQuery("SELECT * FROM cv10_users", []);
        return $results;
    }
    public function findByEmail($email)
    {
        $results = $this->runQuery("SELECT * FROM cv10_users WHERE email like :email", ['email' => $email]);
        return $results;
    }
    public function createUser($email, $password)
    {
        $results = $this->runQuery("INSERT INTO cv10_users (email, password, privilege) values ('$email', '$password', 0) ", []);
        return $results;
    }
    public function updateUser($email, $privilege)
    {
        $results = $this->runQuery("UPDATE cv10_users SET privilege = $privilege WHERE email like '$email'", []);
        return $results;
    }
}
