<?php

require_once '../utils/check-privileges.php';
session_start();

$booksDB = new BooksDB();
$action = $_SERVER['PHP_SELF'];

if (isset($_POST['author']) && ($_POST['author']) != 'Autor') {
  $author = $_POST['author'];
} else if (isset($_SESSION['author']) && !isset($_POST['author'])) {
  $author = $_SESSION['author'];
} else {
  $author = NULL;
}
if (isset($_POST['genre']) && ($_POST['genre']) != 'Žánr') {
  $genre = $_POST['genre'];
} else if (isset($_SESSION['genre']) && !isset($_POST['genre'])) {
  $genre = $_SESSION['genre'];
} else {
  $genre = NULL;
}
if (isset($_POST['world']) && ($_POST['world']) != 'Svět') {
  $world = $_POST['world'];
} else if (isset($_SESSION['world']) && !isset($_POST['world'])) {
  $world = $_SESSION['world'];
} else {
  $world = NULL;
}
if (isset($_POST['publisher']) && ($_POST['publisher']) != 'Nakladatelství') {
  $publisher = $_POST['publisher'];
} else if (isset($_SESSION['publisher']) && !isset($_POST['publisher'])) {
  $publisher = $_SESSION['publisher'];
} else {
  $publisher = NULL;
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

$nItems = $booksDB->countRelated($author, $genre, $world, $publisher, $new_release = NULL, $order == 'not_published' ? 'not_published' : NULL);

$nItemsPerPage = 10;
$nPaginations = ceil($nItems / $nItemsPerPage);

if (isset($_GET["page"])) {
  $page = $_GET["page"];
  $offset = ($page - 1) * $nItemsPerPage;
} else {
  $page = 1;
  $offset = 0;
}

$books = $booksDB->findRelated($author, $genre, $world, $publisher, $order, $new_release = NULL, $nItemsPerPage, $offset);

?>
<?php require '../components/Header.php'; ?>
<?php require '../components/SelectionNav.php'; ?>
<div class="comic-container">
  <div class="comic-headline">
    <h1>Kompletní nabídka</h1>
  </div>
  <form id="book-filter" action="<?php echo $action ?>" method="POST">
    <div class="comic-filter">
      <input type="text" name="author" class="form-control comic-select" placeholder="<?php echo !empty($_SESSION['author']) ? $_SESSION['author'] : 'Autor' ?>">
      <?php require_once '../components/GenreFilter.php'; ?>
      <?php require_once '../components/WorldFilter.php'; ?>
      <?php require_once '../components/PublisherFilter.php'; ?>
      <?php require_once '../components/OrderByFilter.php'; ?>
    </div>
  </form>
  <?php if ($privileges < 2) : ?>
    <div class="comic-print">
      <div class="comic-print-container">
        <?php if (empty($books)) : ?>
          <?php require_once '../components/NoResults.php'; ?>
        <?php else : ?>
          <?php require_once '../components/BookCard.php'; ?>
        <?php endif; ?>
      </div>
    </div>
  <?php else : ?>
    <div class="admin-print">
      <?php if (empty($books)) : ?>
        <?php require_once '../components/NoResults.php'; ?>
      <?php else : ?>
        <?php require_once '../components/BookCard.php'; ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <?php if (!empty($books)) : ?>
    <?php require_once '../components/Pagination.php'; ?>
  <?php endif; ?>
</div>
<?php require '../components/Footer.php'; ?>