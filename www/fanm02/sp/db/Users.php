<?php

require_once './utils/db.php';

class UsersDB extends Database {

    public function getUser($username, $email){
        return ($this->runQuery('SELECT * FROM users WHERE username = ? OR email = ?', [$username, $email]) ?? [])[0];
    }

    public function find(){
        return $this->runQuery('SELECT * FROM users', []);
    }

    public function create($data){
        array_push($data, time());
        return $this->runQuery('INSERT INTO users (username, email, passwordHash, created_at) VALUES (?, ?, ?, ?)', $data);
    }

    public function update($query, $data){
        return $this->runQuery('UPDATE users WHERE ' . $query, $data);
    }

    public function delete($query){
        return $this->runQuery('DELETE FROM users WHERE ' . $query, []);
    }
}

?>