<?php 

require '../Model/ProductDB.php';
require '../Model/CategoryDB.php';
$productDB = new ProductDB();
$categoryDB = new CategoryDB();

$categories = $categoryDB->findAll();
$errors = [];

if (!empty($_POST)) {
    $_POST['name'] = htmlspecialchars(trim($_POST['name']));
    $_POST['description'] = htmlspecialchars(trim($_POST['description']));
    $_POST['price'] = htmlspecialchars(trim($_POST['price']));
    $_POST['img'] = htmlspecialchars(trim($_POST['img']));
    $_POST['category_id'] = htmlspecialchars(trim($_POST['category_id']));

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

    if (empty($errors)) {
        $productDB->createNewProduct($_POST);
        header('Location: ../View/index.php');
        exit();
    }
}

?>