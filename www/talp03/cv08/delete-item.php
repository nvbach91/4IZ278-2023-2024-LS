<?php 

require_once './classes/ProductDB.php';
$productsDB = new ProductDB();

$itemId = $_GET['good_id'];

$productsDB->delete($itemId);
header('Location: index.php');
exit();

?>