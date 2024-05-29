<?php

session_start();

if (isset($_GET['book_id'])) {
  $book_id = $_GET['book_id'];
  $index = array_search($book_id, $_SESSION['cart']);
  if ($index !== false) {
    unset($_SESSION['cart'][$index]);
  }
}

header("Location: /www/lacp06/sp/routes/cart.php");
