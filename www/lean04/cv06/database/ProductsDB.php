<?php

require_once "Database.php";

class ProductsDB extends Database
{
    public function create($data)
    {
    }
    public function find($query)
    {
    }
    public function findAll()
    {
        return $this->runQuery('SELECT * FROM cv06_products;', [])->fetchAll();
    }
    public function findByCategory($query)
    {
        return $this->runQuery('SELECT * FROM cv06_products WHERE category_id = :category_id;', [
            'category_id' => $query['category_id']
        ]);
    }
    public function update($query, $data)
    {
    }
    public function delete($query)
    {
    }
}
