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
}