<?php
// session_start();
require_once __DIR__ . '/db/ProductsDatabase.php';
require __DIR__ . '/includes/userRequired.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$productId = $_GET['productId']; // Assuming the product ID is passed as a GET parameter
$productsDB = new ProductsDatabase();
$product = $productsDB->readProductById($productId)[0];

var_dump($productId);
var_dump($product);

// Check if the product is already in the cart
if (array_key_exists($productId, $_SESSION['cart'])) {
    $_SESSION['cart'][$productId]['quantity'] += $_GET['quantity']; // Increment quantity if already in cart
} else {
    $_SESSION['cart'][$productId] = [
        'idProduct' => $product['idProduct'],
        'name' => $product['name'],
        'price' => $product['price'],
        'discount' => $product['discount'],
        'image' => $product['image'],
        'quantity' => $_GET['quantity']
    ]; // Add new item to cart
}
header('Location: cart.php');
exit();
?>