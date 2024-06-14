<?php

require '../Model/ProductDB.php';
require '../Model/CategoryDB.php';

$productsDB = new ProductDB();

$nItems = $productsDB->countProducts();
$nItemsPerPagination = 9;

$nPaginations = ceil($nItems / $nItemsPerPagination);
$nItemsOnLastPagination = $nItems %  $nItemsPerPagination;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$offset = ($page - 1) * $nItemsPerPagination;

if (isset($_GET['category_id'])) {
    $itemsPerPage = $productsDB->fetchItemsPageByCategory($offset, $nItemsPerPagination, $_GET['category_id']);
} else {
    $itemsPerPage = $productsDB->fetchItemsPage($offset, $nItemsPerPagination);
}

$categoryDB = new CategoryDB();
$categories = $categoryDB->findAll();

?>