<?php

require_once './utils/db.php';
require_once './utils/helpers.php';

class OrdersDB extends Database {

    public function getSellingMeals($seller){
        $sql = 'SELECT *, id AS meal_id FROM sp_meals WHERE chef_id = :seller';
        $statement = $this->prepare($sql);
        $statement->bindParam(':seller', $seller);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getBoughtMeals($seller){
        $sql = 'SELECT * FROM sp_meals JOIN (SELECT * FROM sp_orders WHERE buyer_id = :seller) a ON sp_meals.id = a.meal_id';
        $statement = $this->prepare($sql);
        $statement->bindParam(':seller', $seller);
        $statement->execute();

        return $statement->fetchAll();
    }


    public function getOrdersByBuyer($buyer){
        $sql = 'SELECT * FROM sp_orders WHERE buyer_id = :buyer';
        $statement = $this->prepare($sql);
        $statement->bindParam(':buyer', $buyer);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getOrdersBySeller($seller){
        $sql = 'SELECT * FROM sp_orders WHERE seller_id = :seller';
        $statement = $this->prepare($sql);
        $statement->bindParam(':seller', $seller);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function find(){
        $sql = 'SELECT * FROM sp_orders';
        $statement = $this->prepare($sql);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function create($data){
        array_push($data, currentDate());

        $sql = 'INSERT INTO sp_orders (buyer_id, seller_id, meal_id, filled_at) VALUES (?, ?, ?, ?)';
        $statement = $this->prepare($sql);
        $statement->execute($data);

        return $statement->rowCount() > 0;
    }

    public function update($query, $data){
        $sql = 'UPDATE sp_orders SET ' . $query;
        $statement = $this->prepare($sql);
        $statement->execute($data);

        return $statement->rowCount() > 0;
    }

    public function delete($query){
        $sql = 'DELETE FROM sp_orders WHERE ' . $query;
        $statement = $this->prepare($sql);
        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function findAll(){
        $sql = 'SELECT * FROM sp_orders';
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