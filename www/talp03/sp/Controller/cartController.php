<?php

session_start();
require '../Model/ProductDB.php';

$ids = @$_SESSION['cart'];
$products = [];
$productPrice = [];
$priceSum;

if (is_array($ids) && count($ids)) {
    $productDB = new ProductDB();
    foreach ($ids as $id) {
        $productBuy = $productDB->find('products', 'product_id', $id)[0];
        array_push($products, $productBuy);
        array_push($productPrice, $productBuy['price']);
    }

    $priceSum = array_sum($productPrice);
    $_SESSION['price_sum'] = $priceSum;
}
?>