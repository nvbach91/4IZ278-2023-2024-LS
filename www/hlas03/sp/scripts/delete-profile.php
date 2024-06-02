<?php
session_start();

require_once __DIR__ . '/../db/UsersDB.php';

$userDB = new UsersDB();
$userId = $_SESSION['user_id'];

$userDB->softDelete($userId);

session_destroy();

header('Location: ../index.php');
exit();
?>
