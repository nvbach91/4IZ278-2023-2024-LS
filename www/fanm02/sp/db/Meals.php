<?php

require_once './utils/db.php';
require_once './utils/helpers.php';

class MealsDB extends Database {

    public function getAvailableMeals($sort, $dir){
        if(!in_array($sort, ['pickup_time', 'price'])) $sort = 'pickup_time';
        if(!in_array($dir, ['asc', 'desc'])) $dir = 'asc';
        return  $this->runQuery("SELECT *, id AS meal_id FROM meals WHERE status = 1 ORDER BY $sort $dir", []);
    }

    public function getMeal($id){
        return ($this->runQuery('SELECT * FROM meals WHERE id = ?', [$id]) ?? [])[0];
    }

    public function deleteMeal($id){
        return $this->runQuery('DELETE FROM meals WHERE id = ?', [$id]);
    }

    public function updateMealStatus($id, $status){
        return $this->runQuery('UPDATE meals SET status = ? WHERE id = ?', [$status, $id]);
    }

    public function updateMealInfo($id, $title, $description, $pickupTime, $pickupDorm, $pickupRoom, $price){
        return $this->runQuery('UPDATE meals SET title = ?, description = ?, pickup_time = ?, pickup_dorm = ?, pickup_room = ?, price = ? WHERE id = ?', [$title, $description, $pickupTime, $pickupDorm, $pickupRoom, $price, $id]);
    }

    public function find(){
        return $this->runQuery('SELECT * FROM meals', []);
    }

    public function create($data){
        array_push($data, currentDate());
        array_push($data, currentDate());
        return $this->runQuery('INSERT INTO meals (chef_id, title, description, photo_url, pickup_dorm, pickup_room, pickup_time, price, updated_at, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', $data);
    }

    public function update($query, $data){
        return $this->runQuery('UPDATE meals WHERE ' . $query, $data);
    }

    public function delete($query){
        return $this->runQuery('DELETE FROM meals WHERE ' . $query, []);
    }

    public function findAll(){
        return $this->runQuery('SELECT * FROM meals', []);
    }

    public function fetch($result, $fetchStyle = PDO::FETCH_BOTH){
        return $result->fetch($fetchStyle);
    }

    public function save(){
    }
}

?>