<?php

include 'includes/head.php';

$currentUsername = $_COOKIE['username'];
setcookie("username", $currentUsername, time());
header("Location: index.php"); 

?>







<?php include 'includes/footer.php'; ?>