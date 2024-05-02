<?php

require_once './db/database_eshop.php';

$userDB = new UsersDB();
$user = $userDB->findUser($_COOKIE['name']);

if ($user['privileges'] < 3) {
  header("Location: /www/lacp06/cv10/index.php");
  exit();
}
