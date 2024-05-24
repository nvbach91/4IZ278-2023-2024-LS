<?php

$email = $_COOKIE['email'];
setcookie("email", $email, time());

$user_id = $_COOKIE['user_id'];
setcookie("user_id", $user_id, time());

$privilege = $_COOKIE['privilege'];
setcookie("privilege", $privilege, time());

header("Location: login-page.php");

?>