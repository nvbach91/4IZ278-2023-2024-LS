<?php

require_once './utils/db.php';

class MealsDB extends Database {

    public function getMeals($chef){
        return ($this->runQuery('SELECT * FROM meals WHERE chef_id = ?', [$chef]) ?? [])[0];
    }

    public function find(){
        return $this->runQuery('SELECT * FROM meals', []);
    }

    public function create($data){
        array_push($data, time());
        array_push($data, time());
        return $this->runQuery('INSERT INTO meals (chef_id, title, description, photo_url, pickup_location, pickup_time, updated_at, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', $data);
    }

    public function update($query, $data){
        return $this->runQuery('UPDATE meals WHERE ' . $query, $data);
    }

    public function delete($query){
        return $this->runQuery('DELETE FROM meals WHERE ' . $query, []);
    }
}

?>