<?php

require_once 'Database.php';

class OrderDB extends Database {
    
    public function createOrder($order) {
        $statement = $this->pdo->prepare('INSERT INTO orders (total_price, user_id) VALUES (:total_price, :user_id);');
        $statement->bindValue(':total_price', $order['total_price']);
        $statement->bindValue(':user_id', $order['user_id']);
        $statement->execute();
        $lastId = $this->pdo->lastInsertId();
        return $lastId;
    }

    public function insertOrderProducts($orderId, $productData) {
        $statement = $this->pdo->prepare('INSERT INTO order_products (order_id, product_id, price) VALUES (:order_id, :product_id, :price)');
        $statement->bindValue(':order_id', $orderId);
        $statement->bindValue(':product_id', $productData['product_id']);
        //$statement->bindValue(':quantity', $productData['quantity']);
        $statement->bindValue(':price', $productData['price']);
        $statement->execute();
    }
}

?>