<?php
require_once './db/database_eshop.php';


$productsDB = new ProductsDB();

if (isset($_GET["good_id"])) {
  $good_id = $_GET["good_id"];
  $productsDB->deleteItem($good_id);
}
header("Location: /www/lacp06/cv08/index.php");
