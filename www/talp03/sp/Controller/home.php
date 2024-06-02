<?php

require_once '../Model/UserDB.php';
require '../Model/ProductDB.php';
require '../Model/CategoryDB.php';

$userDB = new UserDB();
$users = $userDB->findAll();

$userPrivilige;

if (isset($_COOKIE['email'])) {
    $user = $userDB->find('users', 'email', $_COOKIE['email'])[0];
    $userPrivilige = $user['privilege'];
}

$productsDB = new ProductDB();
if (isset($_GET['category_id'])) {
    $products = $productsDB->findByCategory($_GET['category_id']);
} else {
    $products = $productsDB->findAll();
}

$categoryDB = new CategoryDB();
$categories = $categoryDB->findAll();

?>