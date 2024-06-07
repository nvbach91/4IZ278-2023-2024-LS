<?php 
require_once __DIR__ . '/../db/ProductsDB.php'; 
require_once __DIR__ . '/../config/global.php'; 
?>
<?php


$productsDB = new ProductsDB();
if (isset($_GET['product_id'])) {
  $product = $productsDB->findByProductId($_GET['product_id']);
  var_dump($product);
} else {
  $product = $productsDB->find();
}

?>


