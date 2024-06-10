<?php 

require '../Model/ProductDB.php';
$productDB = new ProductDB();


$productID = $_GET['product_id'];
$product = $productDB->find('products', 'product_id', $productID)[0];

$lastUpdated = $product['last_updated'];
var_dump($lastUpdated);

if (!empty($_POST)) {
    $_POST['name'] = htmlspecialchars(trim($_POST['name']));
    $_POST['description'] = htmlspecialchars(trim($_POST['description']));
    $_POST['price'] = htmlspecialchars(trim($_POST['price']));
    $_POST['img'] = htmlspecialchars(trim($_POST['img']));
    $_POST['category'] = htmlspecialchars(trim($_POST['category']));

    $lastUpdated = $_POST['last_updated'];
    var_dump($lastUpdated);

    if ($productDB->updateProduct($_POST, $lastUpdated) == false) {
        header('Location: HTTP/1.1 409 Conflict');
        exit();
    } else {
        header('Location: ../View/index.php');
        exit();
    }
}

?>