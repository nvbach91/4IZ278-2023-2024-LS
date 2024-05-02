<?php
session_start();

require_once './db/database_eshop.php';

require_once 'user-check.php';

$productsDB = new ProductsDB();
$products = [];

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

foreach ($_SESSION['cart'] as $product_id) {
  $product = $productsDB->findById($product_id);
  array_push($products, $product);
}

if (empty($_SESSION['cart'])) {
  $noItems = "No items in cart!";
} else {
  $noItems = "";
}

?>

<?php require __DIR__ . '/includes/Header.php'; ?>
<div class="container">
  <h1>Cart</h1>
  <p><?php echo $noItems; ?></p>
  <ul style="list-style: none;">
    <?php foreach ($products as $product) : ?>
      <?php foreach ($product as $value) : ?>
        <li class="page-item" style="max-width: 200px; display: flex; justify-content: space-between; margin-bottom: 10px;">
          <?php echo $value['name'] ?>
          <a href="remove-item.php/?good_id=<?php echo $value['good_id'] ?>">
            <button class="btn btn-primary">remove</button>
          </a>
        </li>
      <?php endforeach; ?>
    <?php endforeach; ?>
  </ul>
</div>
<div style="position: absolute; width: 100%; bottom: 0;">
  <?php require __DIR__ . '/includes/Footer.php'; ?>
</div>