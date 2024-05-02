<?php
require 'user_required.php';
session_start();

if (isset($_GET['good_id'])) {
    $good_id = $_GET['good_id'];

    $index = array_search($good_id, $_SESSION['cart']);

    if ($index !== false) {
        unset($_SESSION['cart'][$index]);

        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// Redirect the user back to the cart page
header('Location: cart.php');
exit;
?>