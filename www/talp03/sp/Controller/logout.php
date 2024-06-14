<?php
setcookie('email', '', time() - 3600, '/cv01/sp/');
session_destroy();
header('Location: /cv01/sp/View/index.php');
?>