<?php require_once __DIR__ . '/Database.php'; ?>

<?php

class OrdersDB extends Database {
    protected $tableName = 'orders';

    public function selectAll () {
        $sql = "SELECT count(order_id) FROM $this->tableName";
        $statement = $this->pdo->query($sql);
        $result = $statement->fetchColumn();
        return $result;
    }


    public function findById($order_id) {
        return $this->findBy('order_id', $order_id);
    }

    public function findByMore($column, $value) {
        $placeholders = rtrim(str_repeat('?,', count($value)), ',');
        $sql = "SELECT * FROM $this->tableName WHERE $column IN ($placeholders)";

        $statement = $this->pdo->prepare($sql);
        $statement->execute($value);
    
        return $statement->fetchAll();
        }

        public function findLast($user_id) {
            $sql = "SELECT order_id FROM $this->tableName WHERE user_id = :user_id ORDER BY order_date DESC LIMIT 1";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                'user_id' => $user_id
            ]);

            return $statement->fetch(PDO::FETCH_ASSOC);
        }

    public function create($data) {
        $sql = "INSERT INTO $this->tableName (user_id, order_date, status, total_price) VALUES (:user_id, :order_date, :status, :total_price)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'user_id' => $data['user_id'], 
            'order_date' => $data['order_date'], 
            'status' => $data['status'],
            'total_price' => $data['total_price']

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

$ordersDB = new OrdersDB();


?>



