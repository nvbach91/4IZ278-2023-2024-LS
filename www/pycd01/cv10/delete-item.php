<?php
include "./classes/Users.php";

$usersDB = new UsersDB();


if (isset($_GET['id'])) {
    $usersDB->delete((int)$_GET['id']);
}
header('Location: main.php');
exit();