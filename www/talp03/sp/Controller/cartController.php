<?php

session_start();
require '../Model/ProductDB.php';

$ids = array_keys($_SESSION['cart']);
$products = [];
$productPrice = [];
$priceSum;
$quantity;

if (is_array($ids) && count($ids)) {
    $productDB = new ProductDB();
    foreach ($ids as $id) {
        $productBuy = $productDB->find('products', 'product_id', $id)[0];
        $quantity = $_SESSION['cart'][$id]['quantity'];
        $productBuy['quantity'] = $quantity;
        array_push($products, $productBuy);
        array_push($productPrice, $productBuy['price']*$quantity);
    }
    var_dump($_SESSION['cart']);
    $priceSum = array_sum($productPrice);
    $_SESSION['price_sum'] = $priceSum;
}
?>