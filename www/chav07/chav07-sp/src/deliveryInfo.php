<?php

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/config.php";
require_once  __DIR__ . "/database/BookRepository.php";
require_once  __DIR__ . "/authentication/AuthUtils.php";
require_once  __DIR__ . "/database/CartObject.php";
require_once __DIR__ . "/cart/plusMinus.php";

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
    <link rel="stylesheet" type="text/css" href="./../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <title>BookBookGo - Delivery</title>
</head>
<body>
<div class="d-flex flex-column full-height">
    <?php require './requires/navigation.php'; ?>

    <main class="container navbar-spacing">
        <h1 class="fs-2 mt-2">Delivery information</h1>
        <form class="container" action="<?php echo htmlspecialchars(BASE_URL . "/orderSummary.php"); ?>" method="post">
            <div class="row">
                <div class="col-4">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" id="email" name="email" type="email" value="<?php echo htmlspecialchars($user->email); ?>"  disabled required>
                </div>
                <div class="col-4">
                    <label class="form-label" for="userName">Name</label>
                    <input class="form-control" id="userName" name="userName" type="text" value="<?php echo htmlspecialchars($user->name); ?>"  disabled required>
                </div>
                <div class="col-4">
                    <label class="form-label" for="tel">Telephone</label>
                    <input class="form-control" id="tel" name="tel" type="tel" placeholder="+420 999 999 999" required>
                </div>

            </div>
            <div class="row mt-4">
                <div class="col-6">
                    <label class="form-label" for="street">Street</label>
                    <input class="form-control" id="street" name="street" type="text" placeholder="1st Avenue 45" required>
                </div>
                <div class="col-4">
                    <label class="form-label" for="city">City</label>
                    <input class="form-control" id="city" name="city" type="text" placeholder="New York" required>
                </div>
                <div class="col-2">
                    <label class="form-label" for="zip">ZIP</label>
                    <input class="form-control" id="zip" name="zip" type="text" placeholder="100 00" required>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3">
                    <label class="form-label" for="paymentMethod">Payment method</label>
                    <select class="form-select" id="paymentMethod" name="paymentMethod" >
                        <option value="Bank transfer" selected>Bank transfer</option>
                    </select>
                </div>

            </div>
            <div class="row mt-4">
                <div class="col-2">
                    <a class="btn btn-outline-secondary" href="<?php echo htmlspecialchars(BASE_URL . "/cart.php"); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"/>
                        </svg>
                        Back
                    </a>
                </div>
                <div class="col-8"></div>
                <div class="col-2 text-end">
                    <button type="submit" class="btn btn-primary">
                            Continue
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
                            </svg>
                    </button>
                </div>
            </div>
        </form>
    </main>

    <?php include __DIR__ . "/includes/footer.php";?>
</div>
<script src="./../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
