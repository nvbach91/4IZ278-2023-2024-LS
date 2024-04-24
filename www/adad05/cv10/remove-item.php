<?php

require 'classes/GoodsDB.php';
session_start();
$goodsDB = new GoodsDB();

$id = $_GET['id'];

foreach ($_SESSION['cart'] as $key => $value) {
    if ($value == $id) {
        unset($_SESSION['cart'][$key]);
    }
}

header("Location: cart.php");
