<?php require_once __DIR__ . '/Database.php'; ?>

<?php

class OrderItemsDB extends Database {
    protected $tableName = 'order_items';

    public function selectAll () {
        $sql = "SELECT count(order_id) FROM $this->tableName";
        $statement = $this->pdo->query($sql);
        $result = $statement->fetchColumn();
        return $result;
    }


    public function findById($order_item_id) {
        return $this->findBy('order_item_id', $order_item_id);
    }

    public function findByMore($column, $value) {
        $placeholders = rtrim(str_repeat('?,', count($value)), ',');
        $sql = "SELECT * FROM $this->tableName WHERE $column IN ($placeholders)";

        $statement = $this->pdo->prepare($sql);
        $statement->execute($value);
    
        return $statement->fetchAll();
        }

    public function create($data) {
        $sql = "INSERT INTO $this->tableName (order_id, product_id, quantity, unit_price) VALUES (:order_id, :product_id, :quantity, :unit_price)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'order_id' => intval($data['order_id']), 
            'product_id' => $data['product_id'], 
            'quantity' => $data['quantity'],
            'unit_price' => $data['unit_price']

        ]);
    }


    function update($productId, $productName, $productPrice, $productImage) {
        $sql = "UPDATE $this->tableName SET product_name = :productName, price = :productPrice, image = :productImage WHERE product_id = :productId";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':productName', $productName);
        $statement->bindParam(':productPrice', $productPrice);
        $statement->bindParam(':productImage', $productImage);
        $statement->bindParam(':productId', $productId);
        $statement->execute();
    }
}

$orderItemsDB = new OrderItemsDB();


?>



