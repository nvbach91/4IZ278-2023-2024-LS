<?php
include_once "./utils/db.php";
class Products
{
    public function __construct(
        public int $good_id,
        public string $name,
        public string $price,
        public string $description,
        public string $img,
    ) { }
} 

class ProductsDB extends Database {
    public function __construct() {
        self::getInstance();
        $this->tableName = 'cv08_goods';
    }
    public function getWithLimit($goods_per_page, $page_offset) {
        $statement = self::$DB->prepare('SELECT * FROM '.$this->tableName.' ORDER BY good_id DESC LIMIT :goods_per_page OFFSET :page_offset');
        $statement->bindValue( ':goods_per_page', $goods_per_page, PDO::PARAM_INT);
        $statement->bindValue( ':page_offset', $page_offset, PDO::PARAM_INT);
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }
    public function read($id)
    {
        $statement = self::$DB->prepare('SELECT * FROM '.$this->tableName.' WHERE good_id = :good_id');
        $statement->bindParam(':good_id', $id, PDO::PARAM_INT);
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }
    public function create($product) 
    {
    $statement = self::$DB->prepare('INSERT INTO '.$this->tableName.' (name, price, description, img) VALUES (:name, :price, :description, :img)');
    $statement->bindValue(':name', $product['name']);
    $statement->bindValue(':description', $product['description']);
    $statement->bindValue(':price', $product['price']);
    $statement->bindValue(':img', $product['img']);
    $statement->execute();
    }

    public function update($product, $id) 
    {
        $statement = self::$DB->prepare('UPDATE '.$this->tableName.' SET name = :name, price = :price, description = :description, img = :img WHERE good_id = :good_id');
        $statement->bindValue(':name', $product['name']);
        $statement->bindValue(':description', $product['description']);
        $statement->bindValue(':price', $product['price']);
        $statement->bindValue(':img', $product['img']);
        $statement->bindValue(':good_id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
}