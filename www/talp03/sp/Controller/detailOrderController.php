<?php

session_start();

require '../Model/OrderDB.php';
require_once '../Model/UserDB.php';
require_once '../Model/ProductDB.php';

$userDB = new UserDB();
$orderDB = new OrderDB();
$productDB = new ProductDB();
$ordersWithProducts = [];
$productArray = [];



if (isset($_GET['order_id'])) {
    $products = $orderDB->findOrderProducts($_GET['order_id']);
    $order = $orderDB->find('orders', 'order_id', $_GET['order_id'])[0];
    foreach ($products as $product) {
        $productInfo = $productDB->find('products', 'product_id', $product['product_id'])[0];
        $productInfoArray = [
            'product_id' => $productInfo['product_id'],
            'name' => $productInfo['name'],
            'price' => $productInfo['price'],
            'img' => $productInfo['img'],
            'description' => $productInfo['description'],
            'quantity' => $product['quantity'],
        ];
        array_push($productArray, $productInfoArray);
    }
}

?>