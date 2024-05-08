<?php
include_once '../controller/db.php';
include '../model/Agencies.php';

class AgenciesDB extends Database {
    public function __construct() {
        self::getInstance();
        $this->tableName = 'sp_agencies';
    }
    public function create($agency) 
    {
        $statement = self::$DB->prepare('INSERT INTO '.$this->tableName.' (name, email, phone) VALUES (:name, :email, :phone)');
        $statement->bindValue(':name', $agency['name']);
        $statement->bindValue(':email', $agency['email']);
        $statement->bindValue(':phone', $agency['phone']);
        $statement->execute();
    }

    public function update($agency, $id) 
    {
        $statement = self::$DB->prepare('UPDATE '.$this->tableName.' SET name = :name, email = :email, phone = :phone WHERE id = :id');
        $statement->bindValue(':name', $agency['name']);
        $statement->bindValue(':email', $agency['email']);
        $statement->bindValue(':phone', $agency['phone']); 
        $statement->execute();
    }
}
