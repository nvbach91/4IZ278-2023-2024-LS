<?php
session_start();

require_once __DIR__ . '/../db/ProductsDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    $productsDB = new ProductsDB();
    $product = $productsDB->findByProductId($product_id);

    if (!$product) {
        header('Location: ../cart');
        exit;
    }

    $available_stock = $product['stock'];

    $cart_quantity = isset($_SESSION['cart'][$product_id]) ? $_SESSION['cart'][$product_id] : 0;

    if ($cart_quantity + $quantity > $available_stock) {
        header('Location: ../cart');
        exit;
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }

    header('Location: ../cart');
    exit;
}
?>
