<?php
session_start();
require_once __DIR__ . '/db/ProductsDB.php';
# session pole pro kosik
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [
        
    ];
}

$productsDB = new ProductDB();
$goodsFound = $productsDB->findItemsByID();

$_SESSION['cart'][] = $goodsFound["good_id"];
header('Location: cart.php');
exit();
?>