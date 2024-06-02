<?php

require_once 'Database.php';

class OrderDB extends Database {
    
    public function createOrder($order) {
        $statement = $this->pdo->prepare('CREATE TEMPORARY TABLE orderID (order_id INT NOT NULL); INSERT INTO orders (total_price, user_id) OUTPUT orderID.order_id VALUES (:total_price, :user_id); ');
        $statement->bindValue(':total_price', $order['total_price']);
        $statement->bindValue(':user_id', $order['user_id']);
        $statement->execute();
    }
}

?>