<?php
require_once 'database.php';
class ProductsDB extends Database {
    public function create($data) {
        // Implement the create method
    }

    public function find($query = []) {
        $sql = "SELECT * FROM cv06_products";
        if (!empty($query)) {
            $sql .= " WHERE " . implode(" AND ", array_map(function ($key) {
                return "$key = :$key";
            }, array_keys($query)));
        }
        return $this->runQuery($sql, $query);
    }
    public function findByCategory($category_id) {
        $sql = "SELECT * FROM cv06_products WHERE category_id = :category_id";
        return $this->runQuery($sql, ['category_id' => $category_id]);
    }

    public function update($query, $data) {
        // Implement the update method
    }

    public function delete($query) {
        // Implement the delete method
    }
}
?>