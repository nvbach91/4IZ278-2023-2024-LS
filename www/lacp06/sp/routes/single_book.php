<?php

require_once '../db/database_class.php';

$booksDB = new BooksDB();
$genresDB = new GenresDB();
$worldsDB = new WorldsDB();
$publishersDB = new PublishersDB();

if (isset($_GET['book_id'])) {
  $id = $_GET['book_id'];
  $book = $booksDB->findById($id);
  $genre = $genresDB->findById($book[0]['genre_id']);
  $world = $worldsDB->findById($book[0]['world_id']);
  $publisher = $publishersDB->findById($book[0]['publisher_id']);
} else {
  header("Location: /www/lacp06/sp/routes/index.php");
}

?>

<?php require '../components/Header.php'; ?>
<?php require '../components/SelectionNav.php'; ?>
<div class="single-container">
  <div class="name">
    <h1><?php echo $book[0]['name']; ?></h1>
  </div>
  <div class="single-print">
    <div class="single-info">
      <?php if ($book[0]['discount']) : ?>
        <p class="discount-price">Cena: <?php echo number_format($book[0]['price'], 2, ',', ' '); ?> Kč</p>
        <p class="regular-price">Vaše Cena: <?php echo number_format($book[0]['price'] - ($book[0]['price'] * $book[0]['discount'] / 100), 2, ',', ' '); ?> Kč</p>
        <div class="discount">-<?php echo $book[0]['discount']; ?>%</div>
      <?php else : ?>
        <p class="regular-price">Cena: <?php echo number_format($book[0]['price'], 2, ',', ' '); ?> Kč</p>
      <?php endif; ?>
      <?php if ($book[0]['units'] >= 5) : ?>
        <p class="units">Skladem</p>
      <?php elseif ($book[0]['units'] < 5 && $book[0]['units'] != 0) : ?>
        <p class="units">Skladem: <?php echo $book[0]['units']; ?></p>
      <?php elseif ($book[0]['publish_date'] > date('Y-m-d')) : ?>
        <p style="color: grey;">Připravujeme</p>
      <?php else : ?>
        <p style="color: grey;"><b>Naskladňujeme</b></p>
      <?php endif; ?>
      <div class="actions">
        <?php if ($book[0]['units'] != 0 or $book[0]['publish_date'] < date('Y-m-d')) : ?>
          <a href="<?php echo $absolutePath; ?>utils/add-cart.php/?book_id=<?php echo $book[0]['id']; ?>">
            <button class="btn btn-danger">Koupit</button>
          </a>
        <?php endif; ?>
        <?php if (isset($_COOKIE['name'])) : ?>
          <a href="<?php echo $absolutePath; ?>utils/create-wishlist.php/?book_id=<?php echo $book[0]['id']; ?>">
            <button class="btn btn-secondary">Wishlist</button>
          </a>
        <?php endif; ?>
      </div>
      <p class="info-headline">POPIS</p>
      <p><?php echo $book[0]['description']; ?></p>
      <div class="rating">Hodnocení: <?php echo $book[0]['rating']; ?>/5</div>
      <p class="info-headline">DODATKOVÉ INFORMACE</p>
      <div class="details">
        <p>Autor:</p>
        <p>
          <a href="<?php echo $absolutePath; ?>routes/filtered.php/?author=<?php echo $book[0]['author']; ?>" style="text-decoration: underline;">
            <?php echo $book[0]['author']; ?>
          </a>
        </p>
        <p>Jazyk:</p>
        <p><?php echo $book[0]['language']; ?></p>
        <p>Žánr:</p>
        <p>
          <a href="<?php echo $absolutePath; ?>routes/filtered.php/?genre_id=<?php echo $genre[0]['id'] ?>" style="text-decoration: underline;">
            <?php echo $genre[0]['name']; ?>
          </a>
        </p>
        <p>Svět:</p>
        <p>
          <a href="<?php echo $absolutePath; ?>routes/filtered.php/?world_id=<?php echo $world[0]['id'] ?>" style="text-decoration: underline;">
            <?php echo $world[0]['name']; ?>
          </a>
        </p>
        <p>Nakladatelství:</p>
        <p>
          <a href="<?php echo $absolutePath; ?>routes/filtered.php/?publisher_id=<?php echo $publisher[0]['id'] ?>" style="text-decoration: underline;">
            <?php echo $publisher[0]['name']; ?>
          </a>
        </p>
        <p>Datum vydání:</p>
        <p><?php echo date("d.m. Y", strtotime($book[0]['publish_date'])); ?></p>
      </div>
    </div>
    <div class="single-image">
      <img src="<?php echo $book[0]['image']; ?>" alt="comic">
    </div>
  </div>
</div>
<?php require '../components/Footer.php'; ?>