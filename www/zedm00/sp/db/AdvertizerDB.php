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

    public function findAdvertizerById($id)
    {
        $query = "SELECT * FROM advertizer WHERE id = :id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePaymentInfo($account_number, $bank_code,  $id){
        $query = "UPDATE advertizer SET account_number = :account_number, bank_code = :bank_code WHERE id = :id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':account_number', $account_number);
        $statement->bindParam(':bank_code', $bank_code);
        $statement->bindParam(':id', $id);
        $statement->execute();
    }
}
