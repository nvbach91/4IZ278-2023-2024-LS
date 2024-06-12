<?php
session_start();


require '../database/ProductsDB.php';



if (!empty($_POST)) {

    $productId = htmlspecialchars(trim($_POST['product_id']));
    $quantity = intval(htmlspecialchars(trim($_POST['quantity'])));

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }

    $statement = $productsDB->findBy('product_id',$productId);


}

header("Location: ../main/cart.php");


?>


