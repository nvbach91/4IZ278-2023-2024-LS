<?php
session_start();

//$cartSessionArray = $_SESSION['cart'];
$id = (int)$_GET['product_id'];

if ((array_key_exists($id, $_SESSION['cart'])) !== false) {
    if ($_SESSION['cart'][$id]['quantity'] > 1) {
        $_SESSION['cart'][$id]['quantity']--;
        header('Location: ../View/cart.php');
        exit();
    }
    unset($_SESSION['cart'][$id]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header('Location: ../View/cart.php');
    exit();    
} else {
    header('Location: ../View/index.php');
    exit('Unable to find this product!');
}
?>