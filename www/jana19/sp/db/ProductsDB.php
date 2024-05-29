<?php
require_once __DIR__ .'/Database.php';

class ProductsDB extends Database {
    protected $tableName = 'cv06_products';
    public function findCategory($category_id) {
        return $this->findWhere('category_id', $category_id);
    }


    public function create($s) {
        $sql = "INSERT INTO cv06_products(name, price, img) VALUES (:name, :price, :img);";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $columns['name'], 
            'price' => $columns['price'], 
            'img' => $columns['img'],
        ]);

    }
}

?>