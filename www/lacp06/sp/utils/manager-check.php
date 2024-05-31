<?php

require_once '../db/database_class.php';

$usersDB = new UsersDB();
$user = $usersDB->findUser($_COOKIE['name']);

if ($user[0]['privileges'] < 2) {
  header("Location: /www/lacp06/sp/routes/index.php");
  exit();
}
