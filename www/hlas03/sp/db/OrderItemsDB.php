<?php

require_once __DIR__ . '/Database.php';

class OrderItemsDB extends Database {
    protected $tableName = 'order_items';

    public function create($orderItemData) {
        $sql = "INSERT INTO $this->tableName (quantity, price, product_id, order_id) VALUES (:quantity, :price, :product_id, :order_id)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($orderItemData);
    }

    public function findByOrderId($order_id) {
        $sql = "SELECT * FROM $this->tableName WHERE order_id = :order_id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['order_id' => $order_id]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
