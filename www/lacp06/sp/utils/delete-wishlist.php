<?php

require_once 'user-check.php';

$wishlistDB = new WishlistsDB();

if (isset($_GET['book_id'])) {
  $book_id = $_GET['book_id'];
  $user_id = $usersDB->findUser($_COOKIE['name'])[0]['id'];
  $user_wishlist = $wishlistDB->delete($user_id, $book_id);
}

header("Location: /www/lacp06/sp/routes/wishlist.php");
