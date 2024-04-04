<?php

require_once __DIR__ . "/db.php";

class ProductsDB extends Database {
    protected $tableName = "cv06_products";

    public function findByCategory($query) {
        return $this->runQuery('SELECT * FROM cv06_products WHERE category_id = :category_id;', [
            'category_id' => $query['category_id']
        ]);
    }
}
