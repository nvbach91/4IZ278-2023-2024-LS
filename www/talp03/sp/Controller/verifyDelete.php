<?php

require_once '../Controller/entryPrivilege.php';
require '../Model/ProductDB.php';

$productsDB = new ProductDB();

if (isset($_GET['product_id'])) {
    $product = $productsDB->find('products', 'product_id', $_GET['product_id'])[0];
}

?>