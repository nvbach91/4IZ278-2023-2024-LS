<?php

require_once 'Database.php';

class CarsDB extends Database
{
    public function find()
    {
        $results = $this->runQuery("SELECT DISTINCT car_id, model from cars", []);
        return $results;
    }
}