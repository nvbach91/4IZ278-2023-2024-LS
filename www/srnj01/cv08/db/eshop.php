<?php

require 'db.php';

class ProductsDB extends DatabaseEshop
{
  public function getPageCount($limit = 5)
  {
    $query = "SELECT COUNT(*) FROM cv08_goods;";
    $result = $this->runQuery($query, []);
    return ceil($result[0]['COUNT(*)'] / $limit);
  }
  public function find($page = 0, $limit = 5)
  {
    $query = "SELECT * FROM cv08_goods ORDER BY good_id DESC";
    return $this->pagination($query, [], $page, $limit);
  }
  public function findById($id)
  {
    $query = "SELECT * FROM cv08_goods WHERE good_id = ?;";
    return $this->runQuery($query, [$id]);
  }
  public function findByIds($ids)
  {
    $query = "SELECT * FROM cv08_goods WHERE good_id IN (" . implode(',', array_fill(0, count($ids), '?')) . ");";
    return $this->runQuery($query, array_values($ids));
  }
  public function add($name, $price, $description, $img)
  {
    $query = "INSERT INTO cv08_goods (name, price, description, img) VALUES (?, ?, ?, ?);";
    $this->runQuery($query, [$name, $price, $description, $img]);
  }
  public function update($id, $name, $price, $description, $img)
  {
    $query = "UPDATE cv08_goods SET name = ?, price = ?, description = ?, img = ? WHERE good_id = ?;";
    $this->runQuery($query, [$name, $price, $description, $img, $id]);
  }
  public function delete($id)
  {
    $query = "DELETE FROM cv08_goods WHERE good_id = ?;";
    $this->runQuery($query, [$id]);
  }
}
