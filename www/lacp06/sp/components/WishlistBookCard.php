<?php

require_once '../utils/absolute-path.php';

?>

<?php foreach ($books as $book) : ?>
  <div class="comic-item">
    <img src="<?php echo $book['image']; ?>" alt="comic">
    <div class="comic-details">
      <p class="name"><a href="single_book.php/?book_id=<?php echo $book['id']; ?>"><?= $book['name'] ?></a></p>
      <?php if ($book['discount']) : ?>
        <p style="text-decoration: line-through;">Cena: <?php echo number_format($book['price'], 2, ',', ' '); ?> Kč</p>
        <div class="discount">-<?php echo $book['discount']; ?>%</div>
        <p style="color: #dc3545;">Vaše Cena: <?php echo number_format($book['price'] - ($book['price'] * $book['discount'] / 100), 2, ',', ' '); ?> Kč</p>
      <?php else : ?>
        <p style="color: #dc3545;">Cena: <?php echo number_format($book['price'], 2, ',', ' '); ?> Kč</p>
      <?php endif; ?>
      <p>Jazyk: <?php echo $book['language']; ?></p>
      <div class="rating">
        <p>Hodnocení: <?php echo $book['rating']; ?>/5</p>
      </div>
      <?php if ($book['units'] > 0) : ?>
        <p class="units">Skladem</p>
      <?php elseif ($book['units'] < 5) : ?>
        <p class="units">Skladem: <?php echo $book['units']; ?></p>
      <?php else : ?>
        <p>Na objednávku</p>
      <?php endif; ?>
      <div class="actions">
        <?php if ($book['units'] != 0 or $book['publish_date'] < date('Y-m-d')) : ?>
          <a href="<?php echo $absolutePath; ?>utils/add-cart.php/?book_id=<?php echo $book['id']; ?>">
            <button class="btn btn-danger">Koupit</button>
          </a>
        <?php endif; ?>
        <a href="<?php echo $absolutePath; ?>utils/delete-wishlist.php/?book_id=<?php echo $book['id']; ?>">
          <button class="btn btn-secondary">Odebrat</button>
        </a>
      </div>
    </div>
  </div>
<?php endforeach; ?>