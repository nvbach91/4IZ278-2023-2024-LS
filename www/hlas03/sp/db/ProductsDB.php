<?php
require_once __DIR__ . '/Database.php';

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

    public function create($name, $price, $description, $stock, $img_format) {
        $sql = "INSERT INTO $this->tableName (name, price, description, stock, img_format) 
                VALUES (:name, :price, :description, :stock, :img_format)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'stock' => $stock,
            'img_format' => $img_format
        ]);

        return $this->pdo->lastInsertId();
    }

    public function assignCategory($product_id, $category_id) {
        $sql = "INSERT INTO product_categories (product_id, category_id) VALUES (:product_id, :category_id)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['product_id' => $product_id, 'category_id' => $category_id]);
    }

    public function update($product_id, $name, $price, $description, $stock) {
        $sql = "UPDATE $this->tableName SET name = :name, price = :price, description = :description, stock = :stock WHERE product_id = :product_id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'stock' => $stock,
            'product_id' => $product_id
        ]);
    }

    public function delete($product_id) {
        $sql = "DELETE FROM $this->tableName WHERE product_id = :product_id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['product_id' => $product_id]);
    }

    public function clearCategories($product_id) {
        $sql = "DELETE FROM product_categories WHERE product_id = :product_id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['product_id' => $product_id]);
    }

    public function findCategoriesByProductId($product_id) {
        $sql = "SELECT category_id FROM product_categories WHERE product_id = :product_id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['product_id' => $product_id]);
        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }
}
?>
