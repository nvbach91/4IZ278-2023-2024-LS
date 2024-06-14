<?php 

require '../Model/ProductDB.php';
require '../Model/CategoryDB.php';
$productDB = new ProductDB();
$categoryDB = new CategoryDB();


$productID = $_GET['product_id'];
$product = $productDB->find('products', 'product_id', $productID)[0];
$categories = $categoryDB->findAll();

$lastUpdated = $product['last_updated'];
$errors = [];

if (!empty($_POST)) {
    $_POST['name'] = htmlspecialchars(trim($_POST['name']));
    $_POST['description'] = htmlspecialchars(trim($_POST['description']));
    $_POST['price'] = htmlspecialchars(trim($_POST['price']));
    $_POST['img'] = htmlspecialchars(trim($_POST['img']));
    $_POST['category'] = htmlspecialchars(trim($_POST['category']));

    if (!is_string($_POST['name'])) {
        array_push($errors, 'Name must be a text!');
    }
    if (!is_string($_POST['description'])) {
        array_push($errors, 'Name must be a text!');
    }
    if (!is_int($_POST['price'])) {
        array_push($errors, 'Name must be a text!');
    }
    if (filter_var($_POST['img'], FILTER_VALIDATE_URL) === FALSE) {
        array_push($errors, 'Invalid URL!');
    }
    if (!is_string($_POST['name'])) {
        array_push($errors, 'Name must be a text!');
    }

    $lastUpdated = $_POST['last_updated'];

    if (empty($errors)) {
        if ($productDB->updateProduct($_POST, $lastUpdated) == false) {
            header('Location: HTTP/1.1 409 Conflict');
            exit();
        } else {
            header('Location: ../View/index.php');
            exit();
        }
    }
}

?>