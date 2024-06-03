<?php 

require '../Model/ProductDB.php';
$productDB = new ProductDB();

if (!empty($_POST)) {
    $productDB->createNewProduct($_POST);
    header('Location: ../View/index.php');
    exit();
}

?>