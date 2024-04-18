<?php

require_once 'db_eshop.php';

class ProductsDB extends DatabaseEshop
{
  public function find()
  {
    $query = "SELECT * FROM cv08_goods;";
    return $this->runQuery($query, []);
  }
  public function findById($id)
  {
    $query = "SELECT * FROM cv08_goods WHERE good_id IN (:good_id);";
    return $this->runQuery($query, [
      ':good_id' => $id
    ]);
  }
  public function countAllProducts()
  {
    $query = "SELECT COUNT(*) FROM cv08_goods;";
    return $this->runCount($query, []);
  }
  public function findItemsPage($nItemsPerPage, $offset)
  {
    $query = "SELECT * FROM cv08_goods ORDER BY good_id DESC LIMIT :nItemsPerPage OFFSET :offset";
    $statement = $this->pdo->prepare($query);
    $statement->bindParam(':nItemsPerPage', $nItemsPerPage, PDO::PARAM_INT);
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  public function deleteItem($id)
  {
    $query = "DELETE FROM cv08_goods WHERE good_id = :good_id";
    $statement = $this->pdo->prepare($query);
    $statement->bindParam(':good_id', $id, PDO::PARAM_INT);
    $statement->execute();
  }
  public function createItem($name, $price, $description, $image)
  {
    $query = "INSERT INTO cv08_goods (name, price, description, img) VALUES (:name, :price, :description, :img)";
    $statement = $this->pdo->prepare($query);
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':price', $price, PDO::PARAM_INT);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':img', $image, PDO::PARAM_STR);
    $statement->execute();
  }
  public function updateItem($id, $name, $price, $description, $image)
  {
    $query = "UPDATE cv08_goods SET name = :name, price = :price, description = :description, img = :img WHERE good_id = :good_id";
    $statement = $this->pdo->prepare($query);
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':price', $price, PDO::PARAM_INT);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':img', $image, PDO::PARAM_STR);
    $statement->bindParam(':good_id', $id, PDO::PARAM_INT);
    $statement->execute();
  }
}
