<?php 

require '../Model/ProductDB.php';
$productDB = new ProductDB();


$productID = $_GET['product_id'];
var_dump($productID);
$product = $productDB->find('products', 'product_id', $productID)[0];

if (!empty($_POST)) {
    $productDB->updateProduct($_POST, $productID);
    header('Location: ../View/index.php');
    exit();
}

?>