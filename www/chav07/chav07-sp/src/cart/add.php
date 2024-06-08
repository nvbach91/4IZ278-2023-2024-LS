<?php

require_once __DIR__ . "/../database/CartObject.php";
require_once __DIR__ . "/../database/BookRepository.php";
require_once __DIR__ . "/../authentication/AuthUtils.php";
require_once __DIR__ . "/../config.php";


//session_start();
startSessionIfNone();

if(!isAuthenticated()){
    header("HTTP/1.1 401 Unauthorized");
    header("location:" . BASE_URL ."/login.php");
    exit(401);
}

if (!isset($_GET["id"])){
    header("HTTP/1.1 404 Not Found");
    header("location:" . BASE_URL ."/");
    exit(404);
}



$id = filter_var(htmlspecialchars(strip_tags($_GET["id"])),FILTER_SANITIZE_NUMBER_INT);

if (!isset($_SESSION["cart"])){
    $_SESSION["cart"] = [];
}
if (isset($_SESSION["cart"][$id])){
    $_SESSION["cart"][$id]->quantity += 1;
    header("HTTP/1.1 200 OK");
    header("location:" . BASE_URL ."/");
    exit(200);
}


$repo = new BookRepository();
$book = $repo->getBookById($id);
if ($book === null){
    header("HTTP/1.1 404 Not Found");
    header("location:" . BASE_URL ."/");
    exit(404);
}

if($book->stock < 1){
    header("HTTP/1.1 400 Bad Request");
    header("location:" . BASE_URL ."/");
    exit(400);
}


$_SESSION["cart"][$id] = new \Vilem\BookBookGo\database\CartObject(1, $book);
header("HTTP/1.1 200 OK");
header("location:" . BASE_URL ."/cart.php");
exit(200);

?>
