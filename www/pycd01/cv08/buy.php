<?php
include "./classes/Products.php";

session_start();

if (!isset($_GET['good_id'])) {
    header("Location: index.php");
    exit();
}
$good_id = $_GET['good_id'];

$products = new ProductsDB();
$good = $products->read($good_id);
$good = $good[0];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
array_push($_SESSION['cart'], $good["good_id"]);
header("Location: index.php");
exit();
