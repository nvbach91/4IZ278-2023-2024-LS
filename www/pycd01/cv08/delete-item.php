<?php
include "./classes/Products.php";

$products = new ProductsDB();


if (isset($_GET['good_id'])) {
    $products->delete($_GET['good_id']);
}
header('Location: index.php');
exit();