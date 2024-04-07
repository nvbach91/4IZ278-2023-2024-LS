<?php

session_start();

if (isset($_GET["good_id"])) {
    unset($_SESSION["cart"][array_search($_GET["good_id"], $_SESSION["cart"])]);
    header('Location: ' . "cart.php");
}
