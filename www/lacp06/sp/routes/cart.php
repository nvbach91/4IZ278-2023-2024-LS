<?php

require_once '../db/database_class.php';
require_once '../utils/absolute-path.php';
session_start();

$booksDB = new BooksDB();

if (empty($_SESSION['cart'])) {
  $cart = [];
} else {
  $cart = $_SESSION['cart'];
}
$books = [];

foreach ($cart as $book_id) {
  $book = $booksDB->findById($book_id);
  array_push($books, $book[0]);
}

if (isset($_SESSION['confirmation'])) {
  $confirmation = $_SESSION['confirmation'];
  unset($_SESSION['confirmation']);
} else {
  $confirmation = 'Prázdný košík';
}

?>

<?php require '../components/Header.php'; ?>
<div class="comic-container">
  <div class="comic-headline">
    <h1>Košík</h1>
  </div>
  <div style="border-top: 3px solid grey;">
    <?php if (!empty($_SESSION['cart'])) : ?>
      <div class="comic-print">
        <div class="cart-container">
          <form action="<?php echo $absolutePath; ?>routes/cart_final.php" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
            <?php foreach ($books as $book) : ?>
              <div class="cart-book">
                <div class="image">
                  <img src="<?php echo $book['image']; ?>" alt="comic">
                </div>
                <div class="cart-details">
                  <div class="comic-details">
                    <p class="name"><a href="<?php echo $absolutePath; ?>routes/single_book.php/?book_id=<?php echo $book['id']; ?>"><?= $book['name'] ?></a></p>
                    <?php if ($book['discount']) : ?>
                      <p style="text-decoration: line-through;">Cena: <?php echo number_format($book['price'], 2, ',', ' '); ?> Kč</p>
                      <div class="cart-discount" style="right: 0; left: 110px;">-<?php echo $book['discount']; ?>%</div>
                      <p style="color: #dc3545;">Vaše Cena: <?php echo number_format($book['price'] - ($book['price'] * $book['discount'] / 100), 2, ',', ' '); ?> Kč</p>
                    <?php else : ?>
                      <p style="color: #dc3545;">Cena: <?php echo number_format($book['price'], 2, ',', ' '); ?> Kč</p>
                    <?php endif; ?>
                    <p>Jazyk: <?php echo $book['language']; ?></p>
                    <div class="rating">
                      <p>Hodnocení: <?php echo $book['rating']; ?>/5</p>
                    </div>
                  </div>
                  <div class="buy-details">
                    <input type="number" name="units_book<?php echo $book['id']; ?>" value="1" max="<?php echo $book['units']; ?>" class="form-control" style="width: 100px;" min="1">
                    <a href="<?php echo $absolutePath; ?>utils/delete-cart.php/?book_id=<?php echo $book['id']; ?>">
                      <button type="button" class="btn btn-danger">Odebrat</button>
                    </a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
            <input type="hidden" name="summary" value="summary">
            <button type="submit" class="btn btn-danger">Pokračovat</button>
          </form>
        </div>
      </div>
    <?php else : ?>
      <div class="cart-empty">
        <h2><?php echo $confirmation; ?></h2>
      </div>
    <?php endif; ?>
  </div>
</div>
<?php require '../components/Footer.php'; ?>