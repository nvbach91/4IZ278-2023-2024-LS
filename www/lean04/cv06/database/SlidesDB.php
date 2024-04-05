<?php

require_once "Database.php";

class SlidesDB extends Database
{
    public function create($data)
    {
    }
    public function find($query)
    {
    }
    public function findAll()
    {
        return $this->runQuery('SELECT * FROM cv06_slides;', [])->fetchAll();
    }
    public function update($query, $data)
    {
    }
    public function delete($query)
    {
    }
}
