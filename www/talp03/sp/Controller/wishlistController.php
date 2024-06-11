<?php

require '../Model/WishlistDB.php';
require '../Model/UserDB.php';

if (!isset($_COOKIE['email'])) {
    header('Location: ../View/index.php');
    exit('Unauthorized');
}

$wishlistDB = new WishlistDB();
$userDB = new UserDB();

$products = [];

$user = $userDB->findUserIDByEmail($_COOKIE['email'])[0];
$wishlist = $wishlistDB->findUserWishlist($user['user_id'])[0];
$products = $wishlistDB->findWishlistProducts($wishlist['wishlist_id']);

?>