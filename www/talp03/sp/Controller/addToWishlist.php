<?php 

require_once '../Model/UserDB.php';
require_once '../Model/WishlistDB.php';

if (!isset($_COOKIE['email'])) {
    header('Location: ../View/index.php');
    exit('Unauthorized');
}

$userDB = new UserDB();
$wishlistDB = new WishlistDB();

$userId = $userDB->findUserIDByEmail($_COOKIE['email'])[0];

if ($wishlistDB->doesUserHaveWishlist($userId['user_id'])) {
    $wishlistId = $wishlistDB->findUserWishlist($userId['user_id'])[0];
    $product = $wishlistDB->findWishlistProduct($wishlistId['wishlist_id'], $_GET['product_id'])[0];
    
    if (!empty($product)) {
        header('Location: ../View/wishlist.php');
        exit('Product already in wishlist!');
    }

    $wishlistDB->insertWishlistProducts($wishlistId['wishlist_id'], $_GET['product_id']);
} else {
    $lastId = $wishlistDB->createWishlist($userId['user_id']);
    $wishlistDB->insertWishlistProducts($lastId, $_GET['product_id']);
}

header('Location: ../View/wishlist.php');
exit();

?>