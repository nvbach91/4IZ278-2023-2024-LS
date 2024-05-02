<?php

session_start();

$cart_items = [];

if (isset($_GET["good_id"])) {
  foreach ($_SESSION['cart'] as $key => $value) {
    if ($value == $_GET['good_id']) {
      unset($_SESSION['cart'][$key]);
    }
  }
}
header("Location: /www/lacp06/cv10/cart.php");
