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

    public function findById($payment_method_id) {
        $sql = "SELECT * FROM $this->tableName WHERE payment_method_id = :payment_method_id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['payment_method_id' => $payment_method_id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
?>
