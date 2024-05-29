<?php
session_start();

setcookie("name", "", time() - 3600, "/");
unset($_SESSION['cart']);
header("Location: /www/lacp06/sp/routes/index.php");
