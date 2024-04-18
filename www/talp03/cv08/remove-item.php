<?php 

session_start();
$cart = $_SESSION['cart'];

$product = $_GET['good_id'];

$_SESSION['cart'] = array_diff($cart, [$product]);
header('Location: cart.php');
exit();

?>