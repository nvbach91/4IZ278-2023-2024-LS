<?php

require 'db.php';

class UsersDB extends DatabaseUser
{
  public function login($email, $password)
  {
    $query = "SELECT * FROM cv11_users WHERE email = ?";
    $data = [$email];
    $user = $this->runQuerySingle($query, $data);
    if (!$user) {
      return false;
    }
    if (password_verify($password, $user['password'])) {
      return $user;
    }
    return false;
  }
  public function register($email, $password)
  {
    $query = "INSERT INTO cv11_users (email, password) VALUES (?, ?)";
    $data = [$email, password_hash($password, PASSWORD_DEFAULT)];
    return $this->runQuery($query, $data);
  }
  public function getUser($email)
  {
    $query = "SELECT * FROM cv11_users WHERE email = ?";
    $data = [$email];
    return $this->runQuerySingle($query, $data);
  }
  public function getUsers()
  {
    $query = "SELECT * FROM cv11_users";
    return $this->runQuery($query, []);
  }
  public function setPrivilege($email, $role)
  {
    $query = "UPDATE cv11_users SET privilege = ? WHERE email = ?";
    $data = [$role, $email];
    return $this->runQuery($query, $data);
  }

  public function getItems()
  {
    $query = "SELECT * FROM cv11_items";
    return $this->runQuery($query, []);
  }
  public function getItem($id)
  {
    $query = "SELECT * FROM cv11_items WHERE id = ?";
    $data = [$id];
    return $this->runQuerySingle($query, $data);
  }
  public function addItem($text)
  {
    $query = "INSERT INTO cv11_items (text) VALUES (?)";
    $data = [$text];
    return $this->runQuery($query, $data);
  }
  public function updateItem($id, $text)
  {
    $query = "UPDATE cv11_items SET text = ? WHERE id = ?";
    $data = [$text, $id];
    return $this->runQuery($query, $data);
  }
  public function deleteItem($id)
  {
    $query = "DELETE FROM cv11_items WHERE id = ?";
    $data = [$id];
    return $this->runQuery($query, $data);
  }
  public function pessimisticUpdateStart($id, $userId)
  {
    $query = "UPDATE cv11_items SET locked_by = ?, locked_at = now() WHERE id = ?";
    $data = [$userId, $id];
    return $this->runQuerySingle($query, $data);
  }
  public function pessimisticUpdateEnd($id)
  {
    $query = "UPDATE cv11_items SET locked_by = NULL, locked_at = NULL WHERE id = ?";
    $data = [$id];
    return $this->runQuerySingle($query, $data);
  }
  public function pessimisticUpdate($id, $text)
  {
    $query = "UPDATE cv11_items SET text = ?, locked_by = NULL, locked_at = NULL WHERE id = ?";
    $data = [$text, $id];
    return $this->runQuery($query, $data);
  }
}
