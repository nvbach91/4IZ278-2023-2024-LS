<?php

use Vilem\BookBookGo\database\CartObject;

require_once __DIR__ . "/config.php";
require_once  __DIR__ . "/../vendor/autoload.php";
require_once  __DIR__ . "/database/BookRepository.php";
require_once  __DIR__ . "/authentication/AuthUtils.php";
require_once  __DIR__ . "/database/CartObject.php";

//session_start();
startSessionIfNone();
if (!isAuthenticated()){
    header("HTTP/1.1 401 Unauthorized");
    header("Location: " . htmlspecialchars(BASE_URL . "/login.php"));
    exit(401);
}
$cart = array();
if (isset($_SESSION["cart"])){
    $cart = $_SESSION["cart"];
}
$totalPrice = 0;
foreach ($cart as $item){
    $totalPrice += $item->quantity * $item->book->price;
}
$valid = false;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./favicon.ico">
    <link rel="stylesheet" type="text/css" href="./../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <title>BookBookGo - Cart</title>
</head>
<body>

<div class="d-flex flex-column full-height">
    <?php require './requires/navigation.php'; ?>

    <main class="container navbar-spacing">
        <h1 class="fs-2 mb-2">Cart</h1>
        <?php if(isset($_SESSION["cart"]) && !empty($_SESSION["cart"])): ?>
            <?php foreach ($cart as $id => $object): ?>
                <section class="row mb-2 shadow rounded-3 cart-item text-start">
                    <div class="col-2 cart-item-col-height d-flex justify-content-start my-1">
                        <img class="object-fit-contain " src="<?php echo BASE_URL . htmlspecialchars($object->book->image_url); ?>" alt="">
                    </div>

                    <h2 class="fs-6 col-3  d-flex flex-column justify-content-center align-items-start ">
                        <a class="text-center" href=""><?php echo htmlspecialchars($object->book->title); ?></a>
                    </h2>

                    <div class="col-3 d-flex flex-column justify-content-center align-items-start">
                        <!--- minus --->
                        <div class="d-flex flex-row">
                            <a class="text-dark me-3" href="<?php echo htmlspecialchars(BASE_URL . "/cart/minus.php?id=".$id);?>">
                                <svg width="32" height="32" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1.5 8a.5.5 0 0 1 .5-.5h28a.5.5 0 0 1 0 1h-28a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            </a>

                            <p><?php echo htmlspecialchars($object->quantity); ?> Pcs</p>
                            <!--- plus --->
                            <a class="text-dark ms-3" href="<?php echo htmlspecialchars(BASE_URL . "/cart/plus.php?id=".$id);?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                                </svg>
                            </a>

                            <p class="ms-3 <?php echo $object->quantity > $object->book->stock ? "text-danger" : "text-success"; ?> "><?php echo htmlspecialchars($object->book->stock); ?> in stock</p>
                        </div>

                    </div>

                    <p class="col-2 text-end d-flex flex-column justify-content-center align-items-end"><?php echo htmlspecialchars($object->book->price * $object->quantity); ?> CZK</p>

                    <div class="col-2 text-end d-flex flex-column justify-content-center align-items-end">
                        <a class="btn btn-danger" href="<?php echo htmlspecialchars(BASE_URL . "/cart/remove.php?id=".$id);?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                            </svg>
                            Remove
                        </a>
                    </div>
                </section>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Your cart is empty</p>
        <?php endif; ?>
        <div class="row mt-4" >
            <div class="col-8"></div>
            <div class="fs-5 col-2 text-end d-flex flex-column justify-content-center align-items-end">Total: <?php echo htmlspecialchars($totalPrice);?> CZK</div>
            <div class="col-2 text-end d-flex flex-column justify-content-center align-items-end">
                <a class="btn btn-primary" href="<?php echo htmlspecialchars(BASE_URL . "/deliveryInfo.php");?>">
                    Continue
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
                    </svg>
                </a>
            </div>
        </div>
    </main>

    <?php include __DIR__ . "/includes/footer.php";?>
    <script src="./../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>