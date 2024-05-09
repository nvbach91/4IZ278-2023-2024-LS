<?php

require_once 'Database.php';

class AssociationDB extends Database
{
    public function find()
    {
        $results = $this->runQuery("SELECT * FROM association", []);
        return $results;
    }
    public function createAssociation($reservation_id, $car_id)
    {
        $results = $this->runQuery("INSERT INTO association (reservation_id, car_id) values ('$reservation_id', '$car_id') ", []);
        return $results;
    }

    public function deleteAssociation($reservation_id, $car_id){
        $results = $this->runQuery("DELETE FROM association WHERE reservation_id like '$reservation_id' and car_id like '$car_id';",[]);
        return $results;
    }

}