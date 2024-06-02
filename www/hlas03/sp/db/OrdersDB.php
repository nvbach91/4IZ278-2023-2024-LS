<?php

require_once __DIR__ . '/Database.php';

class OrdersDB extends Database {
    protected $tableName = 'orders';

    public function create($orderData) {
        $sql = "INSERT INTO $this->tableName (status, created_at, user_id, payment_method_id, shipping_method_id, host_user_id, address_id) 
                VALUES (:status, :created_at, :user_id, :payment_method_id, :shipping_method_id, :host_user_id, :address_id)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($orderData);
        return $this->pdo->lastInsertId();
    }
}
?>
