<?php
include_once '../controller/db.php';
include '../model/homeCustomers.php';

class homeCustomersDB extends Database {
    public function __construct() {
        self::getInstance();
        $this->tableName = 'sp_homecustomers';
    }
    public function create($homeCustomer) 
    {
        $statement = self::$DB->prepare('INSERT INTO '.$this->tableName.' (customer_id, date_followed, home_id) VALUES (:customer_id, :date_followed, :home_id)');
        $statement->bindValue(':customer_id', $homeCustomer['customer_id']);
        $statement->bindValue(':date_followed', $homeCustomer['date_followed']);
        $statement->bindValue(':home_id', $homeCustomer['home_id']);
        $statement->execute();
    }

    public function update($homeCustomer, $id) 
    {
        $statement = self::$DB->prepare('UPDATE '.$this->tableName.' SET customer_id = :customer_id, date_followed = :date_followed, home_id = :home_id WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->bindValue(':customer_id', $homeCustomer['customer_id']);
        $statement->bindValue(':date_followed', $homeCustomer['date_followed']);
        $statement->bindValue(':home_id', $homeCustomer['home_id']);
        $statement->execute();
    }
}