<?php

require_once '../db/database_class.php';

$usersDB = new UsersDB();
$user = $usersDB->findUser($_COOKIE['name']);

if (empty($user)) {
  header("Location: /www/lacp06/sp/routes/login.php");
  exit();
}
