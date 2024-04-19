<?php

require 'db.php';

class ProductsDB extends DatabaseEshop
{
  public function find()
  {
    $query = "SELECT * FROM cv06_products;";
    return $this->runQuery($query, []);
  }
  public function findByCategory($category_id)
  {
    $query = "SELECT * FROM cv06_products WHERE category = :category_id;";
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

class CarouselDB extends DatabaseEshop
{
  public function find()
  {
    $query = "SELECT * FROM cv06_carousel;";
    return $this->runQuery($query, []);
  }
}
