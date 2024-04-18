<?php

require_once 'utils/db.php';

class ProductsDB extends Database {
    public function find() {
        
        $results = $this->runQuery("SELECT * FROM cv06_products", []);
        return $results;
    }
    
    public function findByCategory($category_id) {
        $results = $this->runQuery("SELECT * FROM cv06_products WHERE category_id like :category", ['category' => $category_id]);
        return $results;
    }
}

?>