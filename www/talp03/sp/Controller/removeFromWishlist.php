<?php

require_once '../Model/UserDB.php';
require_once '../Model/ProductDB.php';
require_once '../Model/WishlistDB.php';

$wishlistDB = new WishlistDB();
$userDB = new UserDB();

$productId = (int)$_GET['product_id'];
$user = $userDB->findUserIDByEmail($_COOKIE['email'])[0];
$wishlist = $wishlistDB->findUserWishlist($user['user_id'])[0];

$wishlistDB->removeFromWishlist($wishlist['wishlist_id'], $productId);

header('Location: ../View/wishlist.php');
exit();

?>