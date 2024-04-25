<?php
if (!isset($_SESSION)) {
  session_start();
}

require_once('db/user.php');

if (!isset($_SESSION['email'])) {
  header('Location: login.php');
  exit();
}

$userDB = new UsersDB;

$user = $userDB->getUser($_SESSION['email']);

if ($user['privilege'] < 3) {
  header('Location: index.php');
  exit();
}
