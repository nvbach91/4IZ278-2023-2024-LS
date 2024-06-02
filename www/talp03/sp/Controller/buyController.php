<?php

session_start();
require '../Model/ProductDB.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$productDB = new ProductDB();
$productBuy = $productDB->find('products', 'product_id', $_GET['product_id'])[0];

if (empty($productBuy)) {
    exit("Unable to find product!");
}

$_SESSION['cart'][] = $productBuy['product_id'];
var_dump($_SESSION['cart']);
header('Location: ../View/cart.php');
exit(); 
?>