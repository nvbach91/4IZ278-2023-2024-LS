<?php

session_start();

require_once './db/database_eshop.php';


$productsDB = new ProductsDB();

if (isset($_GET["good_id"])) {
  $good_id = $_GET["good_id"];
  $product = $productsDB->findById($good_id);
  if ($product) {
    if (!isset($_SESSION["cart"])) {
      $_SESSION["cart"] = [];
    }
    array_push($_SESSION["cart"], $product[0]["good_id"]);
  }
  header("Location: /www/lacp06/cv08/cart.php");
} else {
  header("Location: /www/lacp06/cv08/index.php");
}
