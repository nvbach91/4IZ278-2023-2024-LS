<?php

require_once '../utils/check-privileges.php';
session_start();

$booksDB = new BooksDB();
$genresDB = new GenresDB();
$worldsDB = new WorldsDB();
$publishersDB = new PublishersDB();
$wishlistDB = new WishlistsDB();
$usersDB = new UsersDB();
$action = $_SERVER['PHP_SELF'];

if (isset($_GET['author'])) {
  $_SESSION['selected'] = $_GET['author'];
  $_SESSION['selected_type'] = 'author';
  unset($_SESSION['for_me']);
  unset($_SESSION['genre']);
  unset($_SESSION['world']);
  unset($_SESSION['publisher']);
  unset($_SESSION['order']);
} else if (isset($_GET['genre_id'])) {
  $_SESSION['selected'] = $genresDB->findById($_GET['genre_id']);
  $_SESSION['selected_type'] = 'genre';
  unset($_SESSION['for_me']);
  unset($_SESSION['author']);
  unset($_SESSION['world']);
  unset($_SESSION['publisher']);
  unset($_SESSION['order']);
} else if (isset($_GET['world_id'])) {
  $_SESSION['selected'] = $worldsDB->findById($_GET['world_id']);
  $_SESSION['selected_type'] = 'world';
  unset($_SESSION['for_me']);
  unset($_SESSION['author']);
  unset($_SESSION['genre']);
  unset($_SESSION['publisher']);
  unset($_SESSION['order']);
} else if (isset($_GET['publisher_id'])) {
  $_SESSION['selected'] = $publishersDB->findById($_GET['publisher_id']);
  $_SESSION['selected_type'] = 'publisher';
  unset($_SESSION['for_me']);
  unset($_SESSION['author']);
  unset($_SESSION['genre']);
  unset($_SESSION['world']);
  unset($_SESSION['order']);
} else if (isset($_GET['new_release'])) {
  $_SESSION['selected'] = 'Novinky';
  $_SESSION['selected_type'] = 'new_release';
  unset($_SESSION['for_me']);
  unset($_SESSION['author']);
  unset($_SESSION['genre']);
  unset($_SESSION['world']);
  unset($_SESSION['publisher']);
  unset($_SESSION['order']);
} else if (isset($_GET['for_me'])) {
  $_SESSION['selected'] = 'Pro mě';
  $_SESSION['selected_type'] = 'for_me';
  unset($_SESSION['author']);
  unset($_SESSION['genre']);
  unset($_SESSION['world']);
  unset($_SESSION['publisher']);
  unset($_SESSION['order']);

  $user_id = $usersDB->findUser($_COOKIE['name'])[0]['id'];
  $wishlist_books = $wishlistDB->findAll($user_id);

  $_SESSION['wishlist_books'] = $wishlist_books;
  $_SESSION['for_me']['authors'] = [];
  $_SESSION['for_me']['genres'] = [];
  $_SESSION['for_me']['worlds'] = [];
  $_SESSION['for_me']['publishers'] = [];
  foreach ($wishlist_books as $wishlist_book) {
    $book = $booksDB->findById($wishlist_book['book_id']);
    array_push($_SESSION['for_me']['authors'], $book[0]['author']);
    array_push($_SESSION['for_me']['genres'], $book[0]['genre_id']);
    array_push($_SESSION['for_me']['worlds'], $book[0]['world_id']);
    array_push($_SESSION['for_me']['publishers'], $book[0]['publisher_id']);
  }
}

$headline = is_array($_SESSION['selected']) ? $_SESSION['selected'][0]['name'] : $_SESSION['selected'];

if (isset($_POST['author']) && !empty($_POST['author'])) {
  $author = $_POST['author'];
} else if ($_SESSION['selected_type'] == 'author') {
  $author = $_SESSION['selected'];
} elseif (!empty($_SESSION['for_me']['authors'])) {
  $author = $_SESSION['for_me']['authors'];
} else if (isset($_SESSION['author']) && !isset($_POST['author'])) {
  $author = strlen($_SESSION['author']);
} else {
  $author = NULL;
}
if (isset($_POST['genre']) && ($_POST['genre']) != 'Žánr') {
  $genre = $_POST['genre'];
} else if ($_SESSION['selected_type'] == 'genre') {
  $genre = $_SESSION['selected'][0]['id'];
} else if (!empty($_SESSION['for_me']['genres'])) {
  $genre = $_SESSION['for_me']['genres'];
} else if (isset($_SESSION['genre']) && !isset($_POST['genre'])) {
  $genre = strlen($_SESSION['genre']);
} else {
  $genre = NULL;
}
if (isset($_POST['world']) && ($_POST['world']) != 'Svět') {
  $world = $_POST['world'];
} else if ($_SESSION['selected_type'] == 'world') {
  $world = $_SESSION['selected'][0]['id'];
} else if (!empty($_SESSION['for_me']['worlds'])) {
  $world = $_SESSION['for_me']['worlds'];
} else if (isset($_SESSION['world']) && !isset($_POST['world'])) {
  $world = strlen($_SESSION['world']);
} else {
  $world = NULL;
}
if (isset($_POST['publisher']) && ($_POST['publisher']) != 'Nakladatelství') {
  $publisher = $_POST['publisher'];
} else if ($_SESSION['selected_type'] == 'publisher') {
  $publisher = $_SESSION['selected'][0]['id'];
} else if (!empty($_SESSION['for_me']['publishers'])) {
  $publisher = $_SESSION['for_me']['publishers'];
} else if (isset($_SESSION['publisher']) && !isset($_POST['publisher'])) {
  $publisher = strlen($_SESSION['publisher']);
} else {
  $publisher = NULL;
}

if ($_SESSION['selected_type'] == 'new_release') {
  $new_release = true;
} else {
  $new_release = NULL;
}

if (isset($_POST['order'])) {
  $order = $_POST['order'];
} else if (isset($_SESSION['order'])) {
  $order = $_SESSION['order'];
} else {
  $order = NULL;
}

$_SESSION['author'] = $author;
$_SESSION['genre'] = $genre;
$_SESSION['world'] = $world;
$_SESSION['publisher'] = $publisher;
$_SESSION['order'] = $order;

$nItems = $booksDB->countRelated($author, $genre, $world, $publisher, $new_release, $order == 'not_published' ? 'not_published' : NULL);

$nItemsPerPage = 10;
$nPaginations = ceil($nItems / $nItemsPerPage);

if (isset($_GET["page"])) {
  $page = $_GET["page"];
  $offset = ($page - 1) * $nItemsPerPage;
} else {
  $page = 1;
  $offset = 0;
}

$books = $booksDB->findRelated($author, $genre, $world, $publisher, $order, $new_release, $nItemsPerPage, $offset);

?>
<?php require '../components/Header.php'; ?>
<?php require '../components/SelectionNav.php'; ?>
<div class="comic-container">
  <div class="comic-headline">
    <h1><?php echo $headline; ?></h1>
  </div>
  <form id="book-filter" action="<?php echo $action ?>" method="POST">
    <div class="comic-filter">
      <?php if ($_SESSION['selected_type'] != 'author' && $_SESSION['selected_type'] != 'for_me') : ?>
        <input type="text" name="author" class="form-control comic-select" placeholder="<?php echo !empty($_SESSION['author']) ? $_SESSION['author'] : 'Autor' ?>">
      <?php endif; ?>
      <?php if ($_SESSION['selected_type'] != 'genre' && $_SESSION['selected_type'] != 'for_me') : ?>
        <?php require_once '../components/GenreFilter.php'; ?>
      <?php endif; ?>
      <?php if ($_SESSION['selected_type'] != 'world' && $_SESSION['selected_type'] != 'for_me') : ?>
        <?php require_once '../components/WorldFilter.php'; ?>
      <?php endif; ?>
      <?php if ($_SESSION['selected_type'] != 'publisher' && $_SESSION['selected_type'] != 'for_me') : ?>
        <?php require_once '../components/PublisherFilter.php'; ?>
      <?php endif; ?>
      <?php require_once '../components/OrderByFilter.php'; ?>
    </div>
  </form>
  <?php if ($privileges < 2) : ?>
    <div class="comic-print">
      <div class="comic-print-container">
        <?php if (empty($books)) : ?>
          <?php require_once '../components/NoResults.php'; ?>
        <?php elseif (empty($_SESSION['wishlist_books']) && $_SESSION['selected_type'] == 'for_me') : ?>
          <?php require_once '../components/EmptyWishlist.php'; ?>
        <?php else : ?>
          <?php require_once '../components/BookCard.php'; ?>
        <?php endif; ?>
      </div>
    </div>
  <?php else : ?>
    <div class="admin-print">
      <?php if (empty($books)) : ?>
        <?php require_once '../components/NoResults.php'; ?>
      <?php elseif (empty($_SESSION['wishlist_books']) && $_SESSION['selected_type'] == 'for_me') : ?>
        <?php require_once '../components/EmptyWishlist.php'; ?>
      <?php else : ?>
        <?php require_once '../components/BookCard.php'; ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <?php if (!empty($books) && !empty($_SESSION['wishlist_books']) && $_SESSION['selected_type'] == 'for_me' or !empty($books) && $_SESSION['selected_type'] != 'for_me') : ?>
    <?php require_once '../components/Pagination.php'; ?>
  <?php endif; ?>
</div>
<?php require '../components/Footer.php'; ?>