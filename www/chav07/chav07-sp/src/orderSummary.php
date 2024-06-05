<?php

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/config.php";
require_once  __DIR__ . "/database/BookRepository.php";
require_once  __DIR__ . "/authentication/AuthUtils.php";
require_once  __DIR__ . "/database/CartObject.php";
require_once  __DIR__ . "/cart/plusMinus.php";

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

$email = $user->email;
$name = $user->name;
$tel = htmlspecialchars(strip_tags(trim($_POST["tel"])));
$street  = htmlspecialchars(strip_tags(trim($_POST["street"])));
$city = htmlspecialchars(strip_tags(trim($_POST["city"])));
$zip = htmlspecialchars(strip_tags(trim($_POST["zip"])));
$paymentMethod = htmlspecialchars(strip_tags(trim($_POST["paymentMethod"])));



$totalPrice = 0;
foreach ($cart as $item){
    $totalPrice += $item->quantity * $item->book->price;
}

$user = $_SESSION["user"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./favicon.ico">
    <link rel="stylesheet" type="text/css" href="./../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <title>BookBookGo - Order Summary</title>
</head>
<body>
<div class="d-flex flex-column full-height">
    <?php require './requires/navigation.php'; ?>

    <main class="container navbar-spacing">
        <h1 class="fs-2 mt-2">Order Summary</h1>
        <h2 class="fs-4 mt-3">Delivery information</h2>
        <div class="row mt-2">
            <p class="col-4">Email: <?php echo $email; ?></p>
            <p class="col-4">Name: <?php echo $name; ?></p>
            <p class="col-4">Telephone: <?php echo $tel; ?></p>
        </div>
        <div class="row mt-2">
            <p class="col-4">Street: <?php echo $street; ?></p>
            <p class="col-4">City: <?php echo $city; ?></p>
            <p class="col-4">ZIP: <?php echo $zip; ?></p>
        </div>
        <div class="row mt-2">
            <p class="col-4">Payment method: <?php echo $paymentMethod; ?></p>
        </div>
        <h2 class="fs-4 mt-3">Products</h2>
        <div class="row fw-bold">
            <p class="col-2">Title</p>
            <p class="col-2">Price per piece</p>
            <p class="col-2">Quantity</p>
            <p class="col-2">Total price</p>

        </div>
        <div class="row">
            <hr class="col-12">
        </div>
        <?php foreach ($cart as $cartItem): ?>
            <div class="row">
                <p class="col-2"><?php echo htmlspecialchars($cartItem->book->title); ?></p>
                <p class="col-2"><?php echo htmlspecialchars($cartItem->book->price . " CZK"); ?></p>
                <p class="col-2"><?php echo htmlspecialchars("x" . $cartItem->quantity); ?></p>
                <p class="col-2"><?php echo htmlspecialchars($cartItem->quantity * $cartItem->book->price . " CZK"); ?></p>
            </div>
        <?php endforeach; ?>

        <div class="row">
            <div class="col-6"></div>
            <p class="col-2 fw-bold"><?php echo htmlspecialchars($totalPrice . " CZK"); ?></p>
        </div>

        <div class="row mt-4">
            <div class="col-2">
                <a class="btn btn-outline-secondary" href="<?php echo htmlspecialchars(BASE_URL . "/deliveryInfo.php"); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"/>
                    </svg>
                    Back
                </a>
            </div>
            <div class="col-8"></div>
            <form class="col-2 text-end" action="<?php echo htmlspecialchars(BASE_URL . "/placeOrder.php");?>" method="post">
                <input style="display: none;" id="email" name="email" type="email" value="<?php echo htmlspecialchars($user->email); ?>"  disabled required>
                <input style="display: none;" id="userName" name="userName" type="text" value="<?php echo htmlspecialchars($user->name); ?>"  disabled required>
                <input style="display: none;" id="tel" name="tel" type="tel" placeholder="+420 999 999 999" value="<?php echo $tel;?>" required>
                <input style="display: none;" id="street" name="street" type="text" placeholder="1st Avenue 45" value="<?php echo $street;?>" required>
                <input style="display: none;" id="city" name="city" type="text" placeholder="New York" value="<?php echo $city;?>" required>
                <input style="display: none;" id="zip" name="zip" type="text" placeholder="100 00" value="<?php echo $zip;?>" required>
                <select style="display: none;" id="paymentMethod" name="paymentMethod" >
                    <option value="Bank transfer" selected>Bank transfer</option>
                </select>
                <button class="btn btn-primary" type="submit">
                    Place order
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
                    </svg>
                </button>
            </form>
        </div>
    </main>

    <?php include __DIR__ . "/includes/footer.php";?>
</div>
<script src="./../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
