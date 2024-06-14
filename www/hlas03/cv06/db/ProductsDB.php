<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class ProductsDB extends Database {
    protected $tableName = 'cv06_products';
    
    public function findByCategory($category_id) {
        return $this->findBy('category_id', $category_id);
    }

}

?>