<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class ProductsDB extends Database {
    protected $tableName = 'products';
    
    public function findByProductId($product_id) {
        return $this->findBy('product_id', $product_id, false);
    }

    public function findByCategory($category_id) {
        return $this->findByJoin('product_categories', 'product_id', 'product_id', 'category_id', $category_id);
    }
}

?>