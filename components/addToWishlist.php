<?php 
session_start();
require '../database/ProductsDB.php';

if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = [];
}

$statement = $productsDB->findBy('product_id',$_GET['product_id']);

$_SESSION['wishlist'][] = $_GET['product_id'];


header('Location: ../main/wishList.php');



?>