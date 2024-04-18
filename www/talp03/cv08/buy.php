<?php

require_once './classes/ProductDB.php';

session_start();

if (!isset($_GET['good_id'])) {
    header('Location: index.php');
    exit();
}

$goodId = $_GET['good_id'];

$products = new ProductDB();
$item = $products->select($goodId);
$item = $item[0];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

array_push($_SESSION['cart'], $item['good_id']);
header('Location: index.php');
exit();

?>