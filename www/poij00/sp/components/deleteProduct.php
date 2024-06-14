<?php 
session_start();
require '../database/ProductsDB.php';

$productId = $_GET['product_id'];

$productsDB->deleteBy('product_id', $productId);

header('Location: ../main/index.php');