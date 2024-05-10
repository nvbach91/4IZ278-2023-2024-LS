<?php

require 'db.php';

class UsersDB extends DatabaseUser
{
  public function login($email, $password)
  {
    $query = "SELECT * FROM cv10_users WHERE email = ?";
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
    $query = "INSERT INTO cv10_users (email, password) VALUES (?, ?)";
    $data = [$email, password_hash($password, PASSWORD_DEFAULT)];
    return $this->runQuery($query, $data);
  }
  public function getUser($email)
  {
    $query = "SELECT * FROM cv10_users WHERE email = ?";
    $data = [$email];
    return $this->runQuerySingle($query, $data);
  }
  public function getUsers()
  {
    $query = "SELECT * FROM cv10_users";
    return $this->runQuery($query, []);
  }
  public function setPrivilege($email, $role)
  {
    $query = "UPDATE cv10_users SET privilege = ? WHERE email = ?";
    $data = [$role, $email];
    return $this->runQuery($query, $data);
  }
}
