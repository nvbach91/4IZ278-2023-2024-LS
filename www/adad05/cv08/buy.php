<?php

require 'classes/GoodsDB.php';
session_start();
$goodsDB = new GoodsDB();

if (count($goodsDB->checkProductByID($_GET['id']))) {
    $_SESSION['cart'][] = $_GET['id'];
    header("Location: cart.php");
}
