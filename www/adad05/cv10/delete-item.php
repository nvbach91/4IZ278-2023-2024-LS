<?php

require 'classes/GoodsDB.php';
require 'admin-required.php';


$goodsDB = new GoodsDB();
session_start();

$id = $_GET['id'];
$goodsDB->deleteByID($id);

foreach ($_SESSION['cart'] as $key => $value) {
    if ($value == $id) {
        unset($_SESSION['cart'][$key]);
    }
}

header("Location: index.php");
