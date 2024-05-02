<?php

require 'classes/UsersDB.php';
$usersDB = new UsersDB();

if (isset($_COOKIE['username'])) {
    $email = $_COOKIE['username'];
    $users = $usersDB->findByEmail($email);
    if ($users[0]['privilege'] < 2) {
        echo 'Only admin can access this page!';
        header("Location: admin-required-error.php");
        exit;
    }
} else {
    header("Location: admin-required-error.php");
    exit;
}
