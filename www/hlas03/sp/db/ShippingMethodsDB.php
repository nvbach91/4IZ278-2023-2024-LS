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
}

?>
