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

    public function updateStock($product_id, $new_stock) {
        $sql = "UPDATE $this->tableName SET stock = :stock WHERE product_id = :product_id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['stock' => $new_stock, 'product_id' => $product_id]);
    }
}

?>