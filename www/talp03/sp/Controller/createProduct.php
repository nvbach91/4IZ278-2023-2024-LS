<?php 

require '../Model/ProductDB.php';
$productDB = new ProductDB();

if (!empty($_POST)) {
    $_POST['name'] = htmlspecialchars(trim($_POST['name']));
    $_POST['description'] = htmlspecialchars(trim($_POST['description']));
    $_POST['price'] = htmlspecialchars(trim($_POST['price']));
    $_POST['img'] = htmlspecialchars(trim($_POST['img']));
    $_POST['category'] = htmlspecialchars(trim($_POST['category']));

    $productDB->createNewProduct($_POST);
    header('Location: ../View/index.php');
    exit();
}

?>