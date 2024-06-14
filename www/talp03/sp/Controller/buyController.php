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

$ids = array_column($_SESSION['cart'], 'product_id');
$key = array_search($productBuy['product_id'], $ids);
$id = $ids[$key];

if ($key === false) {
    $productArray = [
        'product_id' => $productBuy['product_id'],
        'quantity' => 1
    ];
    $_SESSION['cart'][$productBuy['product_id']] = $productArray; 
} else {
    $_SESSION['cart'][$id]['quantity']++;
}

header('Location: ../View/cart.php');
exit(); 
?>