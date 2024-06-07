<?php

require_once './utils/db.php';
require_once './utils/helpers.php';

class TokensDB extends Database {

    public function getToken($token){
        $sql = 'SELECT * FROM sp_tokens WHERE token = :token';
        $statement = $this->prepare($sql);
        $statement->bindParam(':token', $token);
        $statement->execute();

        return $statement->fetch();
    }

    public function find(){
        $sql = 'SELECT * FROM sp_tokens';
        $statement = $this->prepare($sql);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function create($data){
        array_push($data, currentDate());
        $sql = 'INSERT INTO sp_tokens (email, token, expires_at, created_at) VALUES (?, ?, ?, ?)';
        $statement = $this->prepare($sql);
        $statement->execute($data);
        
        return $statement->rowCount() > 0;
    }

    public function update($query, $data){
        $sql = 'UPDATE sp_tokens SET ' . $query;
        $statement = $this->prepare($sql);
        $statement->execute($data);

        return $statement->rowCount() > 0;
    }

    public function deleteToken($query, $data){
        $sql = 'DELETE FROM sp_tokens WHERE ' . $query;
        $statement = $this->prepare($sql);
        $statement->execute($data);

        return $statement->rowCount() > 0;
    }

    public function findAll(){
        $sql = 'SELECT * FROM sp_tokens';
        $statement = $this->prepare($sql);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function fetch($result, $fetchStyle = PDO::FETCH_BOTH){
        return $result->fetch($fetchStyle);
    }

    public function save(){
    }
}

?>