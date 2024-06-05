<?php

use Vilem\BookBookGo\database\AuthorRepository;
use Vilem\BookBookGo\database\OrderRepository;

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/authentication/AuthUtils.php";
require_once __DIR__ . "/cart/plusMinus.php";
require_once __DIR__ . "/database/User.php";
require_once __DIR__ . "/database/Order.php";
require_once __DIR__ . "/database/BookRepository.php";
require_once __DIR__ . "/database/AuthorRepository.php";



session_start();

if (!isAuthenticated()){
    header("HTTP/1.1 401 Unauthorized");
    header("Location: " . htmlspecialchars(BASE_URL . "/login.php"));
    exit(401);
}
$cart = array();
if (isset($_SESSION["cart"])){
    $cart = $_SESSION["cart"];
    if (empty($cart)){
        header("HTTP/1.1 400 Bad Request");
        header("Location: " . htmlspecialchars(BASE_URL . "/cart.php"));
        exit(400);
    }
}
else{
    header("HTTP/1.1 400 Bad Request");
    header("Location: " . htmlspecialchars(BASE_URL . "/cart.php"));
    exit(400);
}

if (!revalidateCart()){
    header("HTTP/1.1 400 Bad Request");
    header("Location: " . htmlspecialchars(BASE_URL . "/cart.php"));
    exit(400);
}
if (!isset($_POST["tel"])||
    !isset($_POST["street"])||
    !isset($_POST["city"])||
    !isset($_POST["zip"])||
    !isset($_POST["paymentMethod"])
){
    header("HTTP/1.1 400 Bad Request");
    header("Location: " . htmlspecialchars(BASE_URL . "/deliveryInfo.php"));
    exit(400);
}
$user = $_SESSION["user"];

$tel = htmlspecialchars(strip_tags(trim($_POST["tel"])));
$street  = htmlspecialchars(strip_tags(trim($_POST["street"])));
$city = htmlspecialchars(strip_tags(trim($_POST["city"])));
$zip = htmlspecialchars(strip_tags(trim($_POST["zip"])));

$orderRepo = new OrderRepository();
$bookRepo = new BookRepository();
$authorRepo = new AuthorRepository();

$newOrder = new \Vilem\BookBookGo\database\DTOs\OrderCreateDTO($user->id, false, false, $street, $city, $zip, $tel);
$orderRepo->createOrder($newOrder);
$latestOrder = $orderRepo->getUsersLatestOrder($user->id);

foreach($cart as $item){
    $orderRepo->addBookIntoOrder($latestOrder->id, $item->book->id, $item->quantity, $item->book->price);
    $author = $authorRepo->getAuthorByName($item->book->authorName);

//    update book quantity
    $updatedBook = new BookDTO(
        $author->id,
        $item->book->title,
        $item->book->description,
        $item->book->price,
        ($item->book->stock - $item->quantity),
        $item->book->isbn13,
        $item->book->isbn10,
        $item->book->image_url,
    );
    $bookRepo->updateBook( $item->book->id, $updatedBook);

}

unset($_SESSION["cart"]);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./favicon.ico">
    <link rel="stylesheet" type="text/css" href="./../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <title>BookBookGo - Order Complete</title>
</head>
<body>
<div class="d-flex flex-column full-height">
    <?php require './requires/navigation.php'; ?>

    <main class="container navbar-spacing">
        <h1 class="fs-2 mt-2">Order Complete</h1>
        <div >
            <p class="fs-4">Thank you for you order <3</p>
            <p>Your order id is: <?php echo htmlspecialchars($latestOrder->id); ?> please you is as a variable symbol during bank transfer.</p>
        </div>
    </main>

    <?php include __DIR__ . "/includes/footer.php";?>
</div>
<script src="./../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

