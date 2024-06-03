<?php
session_start();

$cartSessionArray = $_SESSION['cart'];
$id = (int)$_GET['product_id'];

if (($key = array_search($id, $cartSessionArray)) !== false) {
    unset($cartSessionArray[$key]);
    $_SESSION['cart'] = array_values($cartSessionArray);
    header('Location: ../View/cart.php');
    exit();    
} else {
    header('Location: ../View/index.php');
    exit('Unable to find this product!');
}
?>