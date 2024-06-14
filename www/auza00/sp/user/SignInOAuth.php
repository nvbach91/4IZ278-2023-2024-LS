<?php
session_start();
require __DIR__ . '/../db/UsersDB.php';
?>
<?php
$usersDB = new UsersDB();
$users = $usersDB->find();

$email = $_COOKIE["oAuthEmail"];

$user = $usersDB->getUserInfoByEmail($email);

$_SESSION['user_id'] = $user['user_id'];
$_SESSION['user_username'] = htmlspecialchars($user['username']);
$_SESSION['user_privilege'] = htmlspecialchars($user['privilege']);
$_SESSION['user_email'] = $email;

header('Location: /../index.php');
exit();
?>