<?php

require_once 'Database.php';

class GoodsDB extends Database
{
    public function find()
    {
        $results = $this->runQuery("SELECT * FROM products", []);
        return $results;
    }
    public function findByCategory($category_id)
    {
        $results = $this->runQuery("SELECT * FROM products WHERE category_id like :category", ['category' => $category_id]);
        return $results;
    }
    public function getNumberOfEntries()
    {
        $result = $this->runQuery("SELECT COUNT(good_id) FROM cv08_goods", []);
        return $result;
    }
    public function getEntriesForPage($limit, $offset)
    {
        $results = $this->runQuery("SELECT * FROM cv08_goods ORDER BY good_id ASC LIMIT $limit OFFSET $offset", []);
        return $results;
    }
    public function checkProductByID($id)
    {
        $results = $this->runQuery("SELECT * FROM cv08_goods WHERE good_id like $id", []);
        return $results;
    }
    public function addProduct($name, $price, $description, $image)
    {
        $results = $this->runQuery("INSERT INTO cv08_goods (name,description,price,img) VALUES ('$name', '$description', $price, '$image')", []);
        return $results;
    }
    public function deleteByID($id)
    {
        $results = $this->runQuery("DELETE FROM cv08_goods WHERE good_id like $id", []);
        return $results;
    }
    public function updateProduct($id, $name, $price, $description, $image)
    {
        $results = $this->runQuery("UPDATE cv08_goods SET name = '$name', price= $price, description = '$description', img = '$image' WHERE good_id like $id;", []);
        return $results;
    }
}
