<?php

require_once __DIR__ . "/../database/CartObject.php";
require_once __DIR__ . "/../authentication/AuthUtils.php";
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../database/BookRepository.php";
function plusMinus(bool $plus)
{
    $id = cartItemValidityCheck();

    $cartObj = $_SESSION["cart"][$id];
    if ($plus){
        $cartObj->quantity = $cartObj->quantity + 1;
    }
    elseif($cartObj->quantity > 1){
        $cartObj->quantity = $cartObj->quantity - 1;
    }

    $_SESSION["cart"][$id] = $cartObj;
    header("HTTP/1.1 200 OK");
    header("location:" . BASE_URL ."/cart.php");
    exit(200);

}
function cartItemValidityCheck() : int
{
//    session_start();
    startSessionIfNone();
    if(!isAuthenticated()){
        header("HTTP/1.1 401 Unauthorized");
        header("location:" . BASE_URL ."/login.php");
        exit(401);
    }

    if (!isset($_SESSION["cart"]) || !isset($_GET["id"])){
        header("HTTP/1.1 404 Not Found");
        header("location:" . BASE_URL ."/");
        exit(404);
    }

    $id = filter_var(htmlspecialchars(strip_tags($_GET["id"])),FILTER_SANITIZE_NUMBER_INT);

    if(!isset($_SESSION["cart"][$id])) {
        header("HTTP/1.1 404 Not Found");
        header("location:" . BASE_URL . "/");
        exit(404);
    }
    return $id;
}

function revalidateCart(): bool {
//    session_start();
    startSessionIfNone();
    if(!isset($_SESSION["cart"])){
        return false;
    }

    $ids = array_keys($_SESSION["cart"]);
    $repo = new BookRepository();
    $currentBooks = $repo->getAllBooks($ids);

    $valid = true;
    foreach ($currentBooks as $book){
        $cartObj = $_SESSION["cart"][$book->id];
//        var_dump($cartObj->quantity);
        if ($cartObj->quantity > $book->stock || $cartObj->book->price !== $book->price){
            $valid = false;
            $_SESSION["cart"][$book->id]->book = $book;
        }
    }

    return $valid;

}

?>
