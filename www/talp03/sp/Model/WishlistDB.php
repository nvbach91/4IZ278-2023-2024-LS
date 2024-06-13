<?php

require_once 'Database.php';

class WishlistDB extends Database {

    public function doesUserHaveWishlist($userId) {
        $statement = $this->pdo->prepare('SELECT user_id FROM wishlist WHERE user_id = :user_id');
        $statement->bindValue(':user_id', $userId);
        $statement->execute();
        if ($statement->rowCount() == 0) {
            return false;
        } else {
            return true;
        };
    }

    public function findWishlistProduct($wishlistId, $productId) {
        $statement = $this->pdo->prepare('SELECT product_id FROM wishlist_products WHERE wishlist_id = :wishlist_id AND product_id = :product_id');
        $statement->bindValue(':wishlist_id', $wishlistId);
        $statement->bindValue(':product_id', $productId);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function findUserWishlist($userId) {
        $statement = $this->pdo->prepare('SELECT wishlist_id FROM wishlist WHERE user_id = :user_id');
        $statement->bindValue(':user_id', $userId);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function findWishlistProducts($wishlistId) {
        $statement = $this->pdo->prepare('SELECT * FROM products JOIN wishlist_products ON products.product_id = wishlist_products.product_id WHERE wishlist_id = :wishlist_id');
        $statement->bindValue(':wishlist_id', $wishlistId);
        $statement->execute();
        return $statement->fetchAll();
    }
    
    public function createWishlist($userId) {
        $statement = $this->pdo->prepare('INSERT INTO wishlist (user_id) VALUES (:user_id);');
        $statement->bindValue(':user_id', $userId);
        $statement->execute();
        $lastId = $this->pdo->lastInsertId();
        return $lastId;
    }

    public function insertWishlistProducts($wishlistId, $productData) {
        $statement = $this->pdo->prepare('INSERT INTO wishlist_products (wishlist_id, product_id) VALUES (:wishlist_id, :product_id)');
        $statement->bindValue(':wishlist_id', $wishlistId);
        $statement->bindValue(':product_id', $productData);
        $statement->execute();
    }

    public function removeFromWishlist($wishlistId, $productId) {
        $statement = $this->pdo->prepare('DELETE FROM wishlist_products WHERE wishlist_id = :wishlist_id AND product_id = :product_id');
        $statement->bindValue(':wishlist_id', $wishlistId);
        $statement->bindValue(':product_id', $productId);
        $statement->execute();
    }
}

?>