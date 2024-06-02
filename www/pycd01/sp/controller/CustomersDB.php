<?php
include_once '../controller/db.php';
include '../model/Customers.php';

class CustomersDB extends Database {
    public function __construct() {
        self::getInstance();
        $this->tableName = 'sp_customers';
    }
    public function create($customer) 
    {
        $statement = self::$DB->prepare('INSERT INTO '.$this->tableName.' (name, email, phone, password) VALUES (:name, :email, :phone, :password)');
        $statement->bindValue(':name', $customer->name);
        $statement->bindValue(':email', $customer->email);
        $statement->bindValue(':phone', $customer->phone);
        $statement->bindValue(':password', $customer->password);
        $statement->execute();
    }

    public function update($customer, $id) 
    {
        $statement = self::$DB->prepare('UPDATE '.$this->tableName.' SET name = :name, email = :email, phone = :phone, password = :password WHERE id = :id');
        $statement->bindValue(':name', $customer->name);
        $statement->bindValue(':email', $customer->email);
        $statement->bindValue(':phone', $customer->phone); 
        $statement->bindValue(':password', $customer->password);
        $statement->execute();
    }
}
