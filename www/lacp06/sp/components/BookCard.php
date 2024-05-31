<?php

require_once '../utils/absolute-path.php';

?>

<?php if ($privileges < 2) : ?>
  <?php foreach ($books as $book) : ?>
    <div class="comic-item">
      <img src="<?php echo $book['image']; ?>" alt="comic">
      <div class="comic-details">
        <p class="name"><a href="<?php echo $absolutePath; ?>routes/single_book.php/?book_id=<?php echo $book['id']; ?>"><?= $book['name'] ?></a></p>
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
        <?php if ($book['units'] >= 5) : ?>
          <p class="units">Skladem</p>
        <?php elseif ($book['units'] < 5 && $book['units'] != 0) : ?>
          <p class="units">Skladem: <?php echo $book['units']; ?></p>
        <?php elseif ($book['publish_date'] > date('Y-m-d')) : ?>
          <p>Připravujeme</p>
        <?php else : ?>
          <p>Naskladňujeme</p>
        <?php endif; ?>
        <div class="actions">
          <?php if ($book['units'] != 0 or $book['publish_date'] < date('Y-m-d')) : ?>
            <a href="<?php echo $absolutePath; ?>utils/add-cart.php/?book_id=<?php echo $book['id']; ?>">
              <button class="btn btn-danger">Koupit</button>
            </a>
          <?php endif; ?>
          <?php if (isset($_COOKIE['name'])) : ?>
            <a href="<?php echo $absolutePath; ?>utils/create-wishlist.php/?book_id=<?php echo $book['id']; ?>">
              <button class="btn btn-secondary">Wishlist</button>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
<?php else : ?>
  <?php if ($privileges > 2) : ?>
    <div class="admin-button">
      <a href="<?php echo $absolutePath; ?>routes/admin_book.php">
        <button class="btn btn-secondary">Přidat knihu</button>
      </a>
    </div>
  <?php endif; ?>
  <?php foreach ($books as $book) : ?>
    <div class="admin-item">
      <table>
        <tr>
          <th>ID</th>
          <th>Název</th>
          <th>Cena</th>
          <th>Sleva</th>
          <th>Cena %</th>
          <th>Jazyk</th>
          <th>Hodnocení</th>
          <th>Kusů</th>
          <th>Žánr</th>
          <th>Svět</th>
          <th>Nakl.</th>
        </tr>
        <tr>
          <td><?php echo $book['id']; ?></td>
          <td><?= $book['name'] ?></td>
          <td><?php echo number_format($book['price'], 2, ',', ' ') ?> Kč</td>
          <td><?php echo $book['discount']; ?>%</td>
          <?php if ($book['discount']) : ?>
            <td><?php echo number_format($book['price'] - ($book['price'] * $book['discount'] / 100), 2, ',', ' '); ?> Kč</td>
          <?php else : ?>
            <td><?php echo number_format($book['price'], 2, ',', ' ') ?> Kč</td>
          <?php endif; ?>
          <td><?php echo $book['language']; ?></td>
          <td><?php echo $book['rating']; ?>/5</td>
          <td><?php echo $book['units']; ?></td>
          <td><?php echo $book['genre_id']; ?></td>
          <td><?php echo $book['world_id']; ?></td>
          <td><?php echo $book['publisher_id']; ?></td>
        </tr>
      </table>
      <a href="<?php echo $absolutePath; ?>routes/edit_book.php/?book_id=<?php echo $book['id']; ?>">
        <button class="btn btn-danger" style="height: 100%;">Editovat</button>
      </a>
      <a href="<?php echo $absolutePath; ?>utils/delete-book.php/?book_id=<?php echo $book['id']; ?>">
        <button class="btn btn-dark" style="height: 100%;">SMAZAT</button>
      </a>
    </div>
  <?php endforeach; ?>
<?php endif; ?>