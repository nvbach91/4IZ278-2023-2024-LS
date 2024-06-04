<?php

require_once __DIR__ . "/plusMinus.php";

$id = cartItemValidityCheck();
unset($_SESSION['cart'][$id]);
header("HTTP/1.1 200 OK");
header("location:" . BASE_URL ."/cart.php");
exit(200);
?>
