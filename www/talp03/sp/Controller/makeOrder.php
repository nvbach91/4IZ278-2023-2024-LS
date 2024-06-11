<?php

session_start();

require '../Model/OrderDB.php';
require '../Model/ProductDB.php';
require '../Model/UserDB.php';

$priceSum = $_GET['price'];
$usermMail = $_COOKIE['email'];


if (!empty($_SESSION['cart'])) {

    $productDB = new ProductDB();
    $orderDB = new OrderDB();
    $userDB = new UserDB();

    $userID = array_values($userDB->findUserIDByEmail($usermMail)[0])[0];
    var_dump($userID);
    $order = [
        'total_price' => "$priceSum",
        'user_id' => "$userID",
    ];

    $lastId = $orderDB->createOrder($order);

    $products = [];

    foreach ($_SESSION['cart'] as $productId) {
        $product = $productDB->find('products', 'product_id', $productId)[0];
        array_push($products, $product);
    }

    foreach ($products as $product) {
        $orderDB->insertOrderProducts($lastId, $product);
    }

    $_SESSION['cart'] = [];
    
    $subject = 'Confirmation of your order';
    $message = 'We have recieved your order.' . "\n" .
                'We are now waiting for your payment.';
    $headers = 'From: furniture@example.com' . "\r\n" .
    'Reply-To: furniture@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    $success = mail('talp03@vse.cz', $subject, $message, $headers);
    if (!$success) {
        $errorMessage = error_get_last()['message'];
        var_dump($errorMessage);
    }

    header('Location: ../View/index.php');
    exit('Order succesful!');
} else {
    header('Location: ../View/cart.php');
    exit('Nothing in cart!');
}


?>