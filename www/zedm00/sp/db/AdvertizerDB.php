<?php
require_once __DIR__ . '/DB.php';

class AdvertizerDB extends DB
{
    public function createAdvertizer($username, $password, $name, $address, $description)
    {
        $query = "INSERT INTO advertizer (username, password, created, name, address, description) VALUES (:username, :password, NOW(), :name, :address, :description)";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':address', $address);
        $statement->bindParam(':description', $description);
        $statement->execute();
        $advertizerId = $this->db->lastInsertId();
        return $advertizerId;
    }


    public function findAdvertizerByUsername($username)
    {
        $query = "SELECT * FROM advertizer WHERE username = :username";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

}
