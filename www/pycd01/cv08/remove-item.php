<?php

if (!isset($_GET['good_id'])) {
    header('Location: index.php');
    exit();
}

session_start();
$cart = $_SESSION['cart'];
$_SESSION['cart'] = array_diff($cart, [$_GET['good_id']]);
header('Location: cart.php');
exit();