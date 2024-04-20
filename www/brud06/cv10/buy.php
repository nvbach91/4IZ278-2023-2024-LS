<?php
session_start();

require_once 'db/GoodsDB.php';
$goodsDB = new GoodsDB();

$good_id = $_GET['good_id'];
$product = $goodsDB->find(['good_id' => $good_id]);

if ($product) {
    $_SESSION['cart'][] = $good_id;
    header('Location: cart.php');
    exit;
} else {
    echo "Error: Product not found.";
}