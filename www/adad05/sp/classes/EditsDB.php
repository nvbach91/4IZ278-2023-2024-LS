<?php

require_once 'Database.php';

class EditsDB extends Database
{
    public function find()
    {
        $results = $this->runQuery("SELECT * FROM edits", []);
        return $results;
    }

    public function isEdit($date, $car){
        $results = $this->runQuery("SELECT * from edits where date like '$date' and car like '$car'", []);
        if (count($results) > 0){
            return [true, $results[0]['edit_id'], $results[0]['last_edited']];
        }
        return [false, ''];
    }

    public function createEdit($date, $car, $date_time)
    {
        $results = $this->runQuery("INSERT INTO edits (date, car, last_edited) values ('$date', '$car', '$date_time') ", []);
        return $results;
    }

    public function updateEdit($edit_id, $date_time)
    {
        $results = $this->runQuery("UPDATE edits SET last_edited = '$date_time' WHERE edit_id like '$edit_id'", []);
        return $results;
    }


}