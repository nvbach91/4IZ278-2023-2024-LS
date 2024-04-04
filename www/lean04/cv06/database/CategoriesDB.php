<?php

require_once "Database.php";

class CategoriesDB extends Database
{
    public function create($data)
    {
    }
    public function find($query)
    {
    }
    public function findAll()
    {
        return $this->runQuery('SELECT * FROM cv06_categories;', []);
    }
    public function update($query, $data)
    {
    }
    public function delete($query)
    {
    }
}
