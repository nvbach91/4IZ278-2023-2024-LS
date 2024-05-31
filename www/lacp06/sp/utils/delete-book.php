<?php

require_once '../db/database_class.php';

$booksDB = new BooksDB();
$wishlistsDB = new WishlistsDB();

if (isset($_GET['book_id'])) {
  $book_id = $_GET['book_id'];
  $booksDB->delete($book_id);
  $wishlistsDB->deleteBook($book_id);
  header("Location: /www/lacp06/sp/routes/index.php");
}
