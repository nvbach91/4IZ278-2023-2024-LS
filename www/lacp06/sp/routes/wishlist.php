<?php

require_once '../db/database_class.php';
require_once '../utils/user-check.php';

$booksDB = new BooksDB();
$wishlistDB = new WishlistsDB();
$usersDB = new UsersDB();

$user_id = $usersDB->findUser($_COOKIE['name'])[0]['id'];
$wishlist_books = $wishlistDB->findAll($user_id);

$books = [];
foreach ($wishlist_books as $wishlist_book) {
  $book = $booksDB->findById($wishlist_book['book_id']);
  array_push($books, $book[0]);
}

?>

<?php require '../components/Header.php'; ?>
<div class="comic-container">
  <div class="comic-headline">
    <h1>Wishlist</h1>
  </div>
  <div style="border-top: 3px solid grey;">
    <div class="comic-print">
      <div class="comic-print-container">
        <?php if (empty($books)) : ?>
          <?php require_once '../components/EmptyWishlist.php'; ?>
        <?php else : ?>
          <?php require_once '../components/WishlistBookCard.php'; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php require '../components/Footer.php'; ?>