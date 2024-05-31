<?php
session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

if (isset($_GET['book_id'])) {
  $book_id = $_GET['book_id'];
  if (array_search($book_id, $_SESSION['cart']) === false) {
    array_push($_SESSION['cart'], $_GET['book_id']);
  }
}

header("Location: /www/lacp06/sp/routes/cart.php");
