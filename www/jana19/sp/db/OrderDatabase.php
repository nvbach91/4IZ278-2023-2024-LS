<?php
require_once __DIR__ . '/Database.php';

class OrdersDatabase extends Database
{
    protected $tableName = 'Order';
    protected $tableNameRelation = 'OrderProducts';
    protected $tableId = 'idOrder';


    public function readAllOrders()
    {
        //return $this->readAll($this->tableProduct);
        return $this->readAll($this->tableName);
    }

    public function readOrderById($orderId)
    {
        $sql = "SELECT * FROM `$this->tableName` WHERE $this->tableId  = :idOrder;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':idOrder' => $orderId]);
        return $statement->fetchAll();
    }

    public function createOrder($userId, $date, $state)
    {
        $sql = "INSERT INTO `$this->tableName` (idUser, date, state) VALUES (:idUser, :date, 'pending');";


        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':idUser', $userId);
        $statement->bindParam(':date', $date);
        // $statement->bindParam(':state', $state);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        } else {
            return false;
        }
    }

    public function createOrderProduct($orderId, $productId, $quantity, $price, $discount)
    {
        $sql = "INSERT INTO $this->tableNameRelation ($this->tableId, idProduct, productQuantity, productPrice, productDiscount) VALUES (:idOrder, :idProduct, :productQuantity, :productPrice, :productDiscount)";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':idOrder', $orderId);
        $statement->bindParam(':idProduct', $productId);
        $statement->bindParam(':productQuantity', $quantity);
        $statement->bindParam(':productPrice', $price);
        $statement->bindParam(':productDiscount', $discount);

        return $statement->execute();
    }

    public function updateOrder($orderId, $newState)
    {
        $sql = "UPDATE `$this->tableName` SET `state`= :newState WHERE `$this->tableId` = :orderId;";


        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':newState', $newState);
        $statement->bindParam(':orderId', $orderId);

        return $statement->execute();
    }
}
