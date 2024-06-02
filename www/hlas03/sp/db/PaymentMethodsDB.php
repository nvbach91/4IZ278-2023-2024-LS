<?php

require_once __DIR__ . '/Database.php';

class PaymentMethodsDB extends Database {
    protected $tableName = 'payment_methods';

    public function findAll() {
        $sql = "SELECT * FROM $this->tableName";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
}

?>
