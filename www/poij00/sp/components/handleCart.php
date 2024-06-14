<?php
session_start();
require '../database/ProductsDB.php';


$ids = @$_SESSION['cart'];

if (is_array($ids) && count($ids)>0) {

  $placeholders = implode(',', array_fill(0, count($ids), '?'));
  $products = $productsDB->findByMore('product_id', array_keys($ids));



  }



  ?>