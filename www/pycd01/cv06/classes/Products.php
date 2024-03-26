<?php
include_once './utils/db.php';
class Products
{
    public function __construct(
        public int $product_id,
        public string $name, 
        public int $price,
        public int $category_id,
        public string $url,
    ) { }
} 

class ProductsDB extends Database {
    public function __construct() {
        self::getInstance();
        $this->tableName = 'products';
    }
    public function create($product) 
    {
    $statement = self::$DB->prepare('INSERT INTO '.$this->tableName.' (product_id, name, price, category_id, url) VALUES (:product_id, :name, :price, :category_id, :url)');
    $statement->bindParam(':product_id', $product->product_id);
    $statement->bindParam(':name', $product->name);
    $statement->bindParam(':price', $product->price);
    $statement->bindParam(':category_id', $product->category_id);
    $statement->bindParam(':url', $product->url);
    $statement->execute();
    $res = $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($product, $id) 
    {
        $statement = self::$DB->prepare('UPDATE '.$this->tableName.' SET name = :name, price = :price, category_id = :category_id, url = :url WHERE id = :id');
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $product->name);
        $statement->bindParam(':price', $product->price);
        $statement->bindParam(':category_id', $product->category_id);
        $statement->bindParam(':url', $product->url);
        $statement->execute();
    }
}