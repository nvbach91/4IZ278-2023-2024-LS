<?php

require_once __DIR__ . '/Database.php';

class OrdersDB extends Database {
    protected $tableName = 'orders';

    public function create($orderData) {
        $sql = "INSERT INTO $this->tableName (status, created_at, user_id, payment_method_id, payment_fee, shipping_method_id, shipping_price, host_user_id, address_id) 
                VALUES (:status, :created_at, :user_id, :payment_method_id, :payment_fee, :shipping_method_id, :shipping_price, :host_user_id, :address_id)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($orderData);
        return $this->pdo->lastInsertId();
    }

    public function findByUserId($user_id) {
        $sql = "SELECT * FROM $this->tableName WHERE user_id = :user_id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['user_id' => $user_id]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOrderItems($order_id) {
        $sql = "SELECT oi.*, p.name FROM order_items oi JOIN products p ON oi.product_id = p.product_id WHERE oi.order_id = :order_id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['order_id' => $order_id]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMonthlyEarnings($year, $month = null) {
        $sql = "
            SELECT 
                DATE_FORMAT(created_at, '%Y-%m') AS month, 
                SUM(oi.quantity * oi.price) AS total,
                COUNT(DISTINCT o.order_id) AS order_count
            FROM 
                $this->tableName o
            JOIN 
                order_items oi ON o.order_id = oi.order_id
            WHERE 
                DATE_FORMAT(created_at, '%Y') = :year";
        
        if ($month) {
            $sql .= " AND DATE_FORMAT(created_at, '%m') = :month";
        }

        $sql .= "
            GROUP BY 
                month
            ORDER BY 
                month ASC
        ";
        
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':year', $year, PDO::PARAM_STR);

        if ($month) {
            $statement->bindValue(':month', $month, PDO::PARAM_STR);
        }

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
