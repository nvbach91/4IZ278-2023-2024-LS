<?php 

require '../Model/ProductDB.php';
$productDB = new ProductDB();


$productID = $_GET['product_id'];
$product = $productDB->find('products', 'product_id', $productID)[0];

if (!empty($_POST)) {
    $productDB->updateProduct($_POST);
    header('Location: ../View/index.php');
    exit();
}

?>