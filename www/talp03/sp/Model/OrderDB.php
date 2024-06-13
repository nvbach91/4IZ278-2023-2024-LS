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
        $statement->bindValue(':price', $productData['price']);
        $statement->execute();
    }

    public function findOrder($userId) {
        $statement = $this->pdo->prepare('SELECT * FROM orders WHERE user_id = :user_id');
        $statement->bindValue(':user_id', $userId);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function updateOrderState($orderId, $state) {
        $statement = $this->pdo->prepare('UPDATE orders SET state = :state WHERE order_id = :order_id');
        $statement->bindValue(':state', $state, PDO::PARAM_STR);
        $statement->bindValue(':order_id', $orderId, PDO::PARAM_INT);
        $statement->execute();
    }

    public function deleteOrder($orderId) {
        $statement = $this->pdo->prepare('DELETE FROM orders WHERE order_id = :order_id');
        $statement->bindValue(':order_id', $orderId);
        $statement->execute();
    }
}

?>