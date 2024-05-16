<?php

require_once 'Database.php';

class CarsDB extends Database
{
    public function find()
    {
        $results = $this->runQuery("SELECT DISTINCT car_id, model, capacity from cars", []);
        return $results;
    }
    
    public function findByName($model)
    {
        $results = $this->runQuery("SELECT DISTINCT car_id, model, capacity from cars where model like '$model'", []);
        return $results;
    }

    public function createCar($model, $capacity)
    {
        $results = $this->runQuery("INSERT INTO cars (model, capacity) values ('$model', '$capacity') ", []);
        return $results;
    }

    public function changeCapacity($car_id, $capacity)
    {
        $results = $this->runQuery("UPDATE cars SET capacity = $capacity where car_id like '$car_id' ", []);
        return $results;
    }
}