<?php
setcookie('display_name', '', time() - 3600, "/");
setcookie('photo_url', '', time() - 3600, "/");

session_start();
unset($_SESSION['user']);
session_destroy();

header('Location: index.php');
exit;

?>

