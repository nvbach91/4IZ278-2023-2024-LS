<?php

require_once './db/database_eshop.php';

$userDB = new UsersDB();
$user = $userDB->findUser($_COOKIE['name']);

if (empty($user)) {
  header("Location: /www/lacp06/cv10/login.php");
  exit();
}
