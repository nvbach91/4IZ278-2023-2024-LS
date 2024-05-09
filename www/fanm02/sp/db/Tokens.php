<?php

require_once './utils/db.php';

class TokensDB extends Database {

    public function getToken($email, $token){
        return ($this->runQuery('SELECT * FROM tokens WHERE email = ? OR token = ?', [$email, $token]) ?? [])[0];
    }

    public function find(){
        return $this->runQuery('SELECT * FROM tokens', []);
    }

    public function create($data){
        array_push($data, time());
        return $this->runQuery('INSERT INTO tokens (email, token, created_at) VALUES (?, ?, ?)', $data);
    }

    public function update($query, $data){
        return $this->runQuery('UPDATE tokens WHERE ' . $query, $data);
    }

    public function delete($query){
        return $this->runQuery('DELETE FROM tokens WHERE ' . $query, []);
    }
}

?>