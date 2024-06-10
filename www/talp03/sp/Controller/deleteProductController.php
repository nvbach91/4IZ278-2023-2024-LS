<?php

require_once '../Controller/entryPrivilege.php';
require '../Model/ProductDB.php';

$productsDB = new ProductDB();

if (isset($_GET['product_id'])) {
    $productsDB->deleteProduct($_GET['product_id']);
}

header('Location: ../View/index.php');
exit();

?>