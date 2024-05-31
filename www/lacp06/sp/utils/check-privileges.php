<?php

require_once '../db/database_class.php';

$usersDB = new UsersDB();

if (isset($_COOKIE["name"])) {
  $user = $usersDB->findUser($_COOKIE['name']);
  $privileges = $user[0]['privileges'];
} else {
  $privileges = 0;
}
