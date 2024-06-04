<?php

require_once './utils/db.php';
require_once './utils/helpers.php';

class TokensDB extends Database {

    public function getToken($token){
        return ($this->runQuery('SELECT * FROM tokens WHERE token = ?', [$token]) ?? [])[0];
    }

    public function find(){
        return $this->runQuery('SELECT * FROM tokens', []);
    }

    public function create($data){
        array_push($data, currentDate());
        return $this->runQuery('INSERT INTO tokens (email, token, expires_at, created_at) VALUES (?, ?, ?, ?)', $data);
    }

    public function update($query, $data){
        return $this->runQuery('UPDATE tokens WHERE ' . $query, $data);
    }

    public function deleteToken($query, $data){
        return $this->runQuery('DELETE FROM tokens WHERE ' . $query, $data);
    }

    public function findAll(){
        return $this->runQuery('SELECT * FROM tokens', []);
    }

    public function fetch($result, $fetchStyle = PDO::FETCH_BOTH){
        return $result->fetch($fetchStyle);
    }

    public function save(){
    }
}

?>