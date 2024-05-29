<?php

require_once 'user-check.php';

$wishlistDB = new WishlistsDB();

if (!isset($_COOKIE['name'])) {
  header("Location: /www/lacp06/sp/routes/login.php");
  exit();
}

if (isset($_GET['book_id'])) {
  $book_id = $_GET['book_id'];
  $user_id = $usersDB->findUser($_COOKIE['name'])[0]['id'];
  $user_wishlist = $wishlistDB->findAll($user_id);
  if (in_array($book_id, array_column($user_wishlist, 'book_id'))) {
    header("Location: /www/lacp06/sp/routes/index.php");
    exit();
  } else {
    $wishlistDB->create($user_id, $book_id);
  }
}

header("Location: /www/lacp06/sp/routes/wishlist.php");
