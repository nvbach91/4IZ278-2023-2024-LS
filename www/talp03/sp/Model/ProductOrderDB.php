<?php

require_once 'Database.php';

class ProductOrderDB extends Database {
    
    public function createListOfOrderProducts($order) {
        $statement = $this->pdo->prepare('INSERT INTO order_products (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)');
        $statement->bindValue(':total_price', $order['total_price']);
        $statement->bindValue(':user_id', $order['user_id']);
        $statement->execute();
    }
}

?>