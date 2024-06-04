<?php

require_once './utils/db.php';
require_once './utils/helpers.php';

class MealsDB extends Database {

    public function getAvailableMeals($sort, $dir){
        if(!in_array($sort, ['pickup_time', 'price'])) $sort = 'pickup_time';
        if(!in_array($dir, ['asc', 'desc'])) $dir = 'asc';

        $sql = "SELECT *, id AS meal_id FROM sp_meals WHERE status = 1 ORDER BY $sort $dir";

        return $this->runQuery($sql, []);
    }

    public function getMeal($id){
        $sql = 'SELECT * FROM sp_meals WHERE id = :id';
        $statement = $this->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();

        return $statement->fetch();
    }

    public function deleteMeal($id){
        $sql = 'DELETE FROM sp_meals WHERE id = :id';
        $statement = $this->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function updateMealStatus($id, $status){
        $sql = 'UPDATE sp_meals SET status = :status WHERE id = :id';
        $statement = $this->prepare($sql);
        $statement->bindParam(':status', $status);
        $statement->bindParam(':id', $id);
        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function updateMealInfo($id, $title, $description, $pickupTime, $pickupDorm, $pickupRoom, $price){
        $sql = 'UPDATE sp_meals SET title = :title, description = :description, pickup_time = :pickup_time, pickup_dorm = :pickup_dorm, pickup_room = :pickup_room, price = :price WHERE id = :id';
        $statement = $this->prepare($sql);
        $statement->bindParam(':title', $title);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':pickup_time', $pickupTime);
        $statement->bindParam(':pickup_dorm', $pickupDorm);
        $statement->bindParam(':pickup_room', $pickupRoom);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':id', $id);
        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function find(){
        $sql = 'SELECT * FROM sp_meals';
        $statement = $this->prepare($sql);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function create($data){
        array_push($data, currentDate());
        array_push($data, currentDate());

        $sql = 'INSERT INTO sp_meals (chef_id, title, description, photo_url, pickup_dorm, pickup_room, pickup_time, price, updated_at, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $statement = $this->prepare($sql);
        $statement->execute($data);

        return $statement->rowCount() > 0;
    }

    public function update($query, $data){
        $sql = 'UPDATE sp_meals SET ' . $query;
        $statement = $this->prepare($sql);
        $statement->execute($data);

        return $statement->rowCount() > 0;
    }

    public function delete($query){
        $sql = 'DELETE FROM sp_meals WHERE ' . $query;
        $statement = $this->prepare($sql);
        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function findAll(){
        $sql = 'SELECT * FROM sp_meals';
        $statement = $this->prepare($sql);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function fetch($result, $fetchStyle = PDO::FETCH_BOTH){
        return $result->fetch($fetchStyle);
    }

    public function save(){
    }
}

?>