<?php

require_once "Database.php";

class UsersDB extends Database
{
    public function create($data)
    {
        return $this->runQuery('INSERT INTO users (email, password, name) VALUES (:email, :password, :name);', [
            'email' => $data['email'],
            'password' => $data['password'],
            'name' => $data['name'],
        ]);
    }

    public function find($query)
    {
        return $this->runQuery('SELECT * FROM users WHERE user_id = :user_id;', [
            'user_id' => $query['user_id'],
        ])->fetch();
    }


    public function findByEmail($query)
    {
        return $this->runQuery('SELECT * FROM users WHERE email = :email;', [
            'email' => $query['email'],
        ])->fetch();
    }

    public function findAll()
    {
        return $this->runQuery('SELECT * FROM users;', [])->fetchAll();
    }

    public function setPrivilege($data)
    {
        return $this->runQuery('UPDATE users SET privilege = :privilege WHERE user_id = :user_id;', [
            'user_id' => $data['user_id'],
            'privilege' => $data['privilege'],
        ]);
    }

    public function delete($query)
    {
        return $this->runQuery('DELETE FROM users WHERE user_id = :user_id;', [
            'user_id' => $query['user_id'],
        ]);
    }

    public function update($query, $data)
    {
        return $this->runQuery('UPDATE users SET password = :password, name = :name, email = :email WHERE user_id = :user_id;', [
            'email' => $data['email'],
            'password' => $data['password'],
            'name' => $data['name'],
            'user_id' => $query['user_id'],
        ]);
    }
}
