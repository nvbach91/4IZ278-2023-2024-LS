<?php

require_once __DIR__ . '/Database.php';

class ShippingMethodsDB extends Database {
    protected $tableName = 'shipping_methods';

    public function findAll() {
        $sql = "SELECT * FROM $this->tableName";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function findById($shipping_method_id) {
        $sql = "SELECT * FROM $this->tableName WHERE shipping_methods_id = :shipping_methods_id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['shipping_methods_id' => $shipping_method_id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
?>
