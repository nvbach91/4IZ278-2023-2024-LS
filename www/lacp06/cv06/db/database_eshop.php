<?php

require 'db_eshop.php';

class ProductsDB extends DatabaseEshop
{
  public function find()
  {
    $query = "SELECT * FROM cv06_products;";
    return $this->runQuery($query, []);
  }
  public function findByCategory($category_id)
  {
    $query = "SELECT * FROM cv06_products WHERE category_id = :category_id;";
    return $this->runQuery(
      $query,
      [
        ':category_id' => $category_id
      ]
    );
  }
}

class CategoriesDB extends DatabaseEshop
{
  public function find()
  {
    $query = "SELECT * FROM cv06_categories;";
    return $this->runQuery($query, []);
  }
}

class SlidesDB extends DatabaseEshop
{
  public function find()
  {
    $query = "SELECT * FROM cv06_slides;";
    return $this->runQuery($query, []);
  }
}
