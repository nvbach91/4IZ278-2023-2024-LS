<?php

require_once 'Database.php';

class HotelsDB extends Database
{
    public function find()
    {
        $results = $this->runQuery("SELECT * from hotels", []);
        return $results;
    }

    public function createHotel($name, $address)
    {
        $results = $this->runQuery("INSERT INTO hotels (name, address) values ('$name', '$address') ", []);
        return $results;
    }
}