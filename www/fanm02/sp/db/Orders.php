<?php

require_once './utils/db.php';
require_once './utils/helpers.php';

class OrdersDB extends Database {

    public function getSellingMeals($seller){
        return $this->runQuery('SELECT *, id AS meal_id FROM meals WHERE chef_id = ?', [$seller]);
    }

    public function getBoughtMeals($seller){
        return $this->runQuery('SELECT * FROM meals JOIN (SELECT * FROM orders WHERE buyer_id = ?) a ON meals.id = a.meal_id', [$seller]);
    }


    public function getOrdersByBuyer($buyer){
        return $this->runQuery('SELECT * FROM orders WHERE buyer_id = ?', [$buyer]);
    }

    public function getOrdersBySeller($seller){
        return $this->runQuery('SELECT * FROM orders WHERE seller_id = ?', [$seller]);
    }

    public function find(){
        return $this->runQuery('SELECT * FROM orders', []);
    }

    public function create($data){
        array_push($data, currentDate());
        return $this->runQuery('INSERT INTO orders (buyer_id, seller_id, meal_id, filled_at) VALUES (?, ?, ?, ?)', $data);
    }

    public function update($query, $data){
        return $this->runQuery('UPDATE orders WHERE ' . $query, $data);
    }

    public function delete($query){
        return $this->runQuery('DELETE FROM orders WHERE ' . $query, []);
    }

    public function findAll(){
        return $this->runQuery('SELECT * FROM orders', []);
    }

    public function fetch($result, $fetchStyle = PDO::FETCH_BOTH){
        return $result->fetch($fetchStyle);
    }

    public function save(){
    }
}

?>