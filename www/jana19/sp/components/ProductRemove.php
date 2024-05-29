<?php
session_start();

// Check if productId is sent via POST and if the cart session exists
if (isset($_POST['productId']) && isset($_SESSION['cart'])) {
    $productId = $_POST['productId'];

    // Check if the product exists in the cart
    if (array_key_exists($productId, $_SESSION['cart'])) {
        // Remove the product from the cart
        unset($_SESSION['cart'][$productId]);
    }
}

// Redirect back to the cart page
header('Location: ../cart.php');
exit();
?>
