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
  public function updateTimestamp($id, $timestamp)
  {
    $query = "UPDATE cv08_goods SET last_edit = :timestampp WHERE good_id = :good_id";
    $statement = $this->pdo->prepare($query);
    $statement->bindParam(':good_id', $id, PDO::PARAM_INT);
    $statement->bindParam(':timestampp', $timestamp, PDO::PARAM_STR);
    $statement->execute();
  }
  public function updateEditUser($id, $user_id)
  {
    $query = "UPDATE cv08_goods SET user_edit = :user_id WHERE good_id = :good_id";
    $statement = $this->pdo->prepare($query);
    $statement->bindParam(':good_id', $id, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->execute();
  }
}

class UsersDB extends DatabaseEshop
{
  public function findUsers($email)
  {
    $query = "SELECT * FROM cv10_users WHERE email != :email";
    $statement = $this->pdo->prepare($query);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  public function findUser($email)
  {
    $query = "SELECT * FROM cv10_users WHERE email = :email";
    $statement = $this->pdo->prepare($query);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  public function createUser($email, $password)
  {
    $query = "INSERT INTO cv10_users (email, password) VALUES (:email, :password)";
    $statement = $this->pdo->prepare($query);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->execute();
  }
  public function changePrivileges($email, $privileges)
  {
    $query = "UPDATE cv10_users SET privileges = :privileges WHERE email = :email";
    $statement = $this->pdo->prepare($query);
    $statement->bindParam(':privileges', $privileges, PDO::PARAM_INT);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
  }
}
