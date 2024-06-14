<?php require_once __DIR__ . '/Database.php'; ?>

<?php

class ProductsDB extends Database {
    protected $tableName = 'products';

    public function selectAll () {
        $sql = "SELECT count(product_id) FROM $this->tableName";
        $statement = $this->pdo->query($sql);
        $result = $statement->fetchColumn();
        return $result;
    }

    public function findByCategory($category_id) {
        return $this->findBy('category_id', $category_id);
    }

    public function findById($product_id) {
        return $this->findBy('product_id', $product_id);
    }

    public function findByMore($column, $value) {
        $placeholders = rtrim(str_repeat('?,', count($value)), ',');
        $sql = "SELECT * FROM $this->tableName WHERE $column IN ($placeholders)";

        $statement = $this->pdo->prepare($sql);
        $statement->execute($value);
    
        return $statement->fetchAll();
        }

    public function create($data) {
        $sql = "INSERT INTO $this->tableName (product_name, image, price, description, category_id) VALUES (:product_name, :image, :price, :description, :category_id)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'product_name' => $data['product_name'], 
            'price' => $data['price'], 
            'image' => $data['image'],
            'description' => $data['description'],
            'category_id' => $data['category_id']

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

$productsDB = new ProductsDB();


?>



