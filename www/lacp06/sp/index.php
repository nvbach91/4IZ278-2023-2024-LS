<?php

require_once __DIR__ . '/db/database_class.php';

$booksDB = new BooksDB();

$nItems = $booksDB->countAll();
$items = $booksDB->findAll();
$nItemsPerPage = 5;
$nPaginations = ceil($nItems / $nItemsPerPage);

if (isset($_GET["page"])) {
  $page = $_GET["page"];
  $offset = ($page - 1) * $nItemsPerPage;
} else {
  $page = 1;
  $offset = 0;
}
$books = $booksDB->findBooksPage($nItemsPerPage, $offset);

?>

<?php require __DIR__ . '/components/Header.php'; ?>
<?php require __DIR__ . '/components/SelectionNav.php'; ?>
<div class="comic-container">
  <div class="comic-headline">
    <h1>Kompletní nabídka</h1>
  </div>
  <div class="comic-filter">
    <input type="text" class="form-control comic-select" id="exampleInputEmail1" placeholder="Autor">
    <?php require_once __DIR__ . '/components/GenreFilter.php'; ?>
    <?php require_once __DIR__ . '/components/WorldFilter.php'; ?>
    <?php require_once __DIR__ . '/components/PublisherFilter.php'; ?>
    <select class="form-select comic-select" aria-label="Default select example">
      <option selected>Nejnovější</option>
      <option value="4">Nejstarší</option>
      <option value="1">Od nejlevnějšího</option>
      <option value="2">Od nejdražšího</option>
      <option value="3">Abecedně</option>
    </select>
  </div>
  <div class="comic-print">
    <?php foreach ($books as $book) : ?>
      <div class="comic-item">
        <img src="<?= $book['image'] ?>" alt="comic">
        <div class="comic-details">
          <p><?= $book['name'] ?></p>
          <p><?= $book['price'] ?> Kč</p>
          <?php if ($book['units'] > 0) : ?>
            <p>Skladem</p>
          <?php else : ?>
            <p>Na objednávku</p>
          <?php endif; ?>
          <p><?= $book['language'] ?></p>
          <p>Hodnocení: <?= $book['rating'] ?>/5</p>
          <button class="btn btn-primary">Koupit</button>
          <button class="btn btn-primary">Wishlist</button>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php require __DIR__ . '/components/Footer.php'; ?>

<style>
  .comic-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .comic-filter {
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    width: 90vw;
    background-color: grey;
    height: 60px;
  }

  .comic-headline {
    height: 150px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .comic-select {
    display: flex;
    height: 40px;
    justify-content: center;
    cursor: pointer;
    outline: none;
    border-radius: 8px;
    border: 1px red solid;
    width: 150px;
    padding: 0.375rem 0.75rem;
    color: grey;
  }

  .comic-print {
    display: flex;
    margin-top: 50px;
    margin-bottom: 50px;
    flex-wrap: wrap;
    width: 90vw;
    justify-content: space-evenly;
    row-gap: 30px;
    column-gap: 20px;
  }

  .comic-item {
    display: flex;
    flex-direction: column;
  }

  .comic-item img {
    max-width: 160px;
  }
</style>