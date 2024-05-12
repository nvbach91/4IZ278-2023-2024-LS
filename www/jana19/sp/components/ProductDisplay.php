<?php
require_once __DIR__ . '/../db/ProductsDatabase.php';

$productsDB = new ProductsDatabase();
$products = $productsDB->read();

?>

<div class="row">
  <?php foreach($products as $product): ?>
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100 product">
      <a href="#">
        <img class="card-img-top product-image" src="<?php echo htmlspecialchars($product['img'], ENT_QUOTES, 'UTF-8'); ?>" alt="tea-package-image">
      </a>
      <div class="card-body">
        <h4 class="card-title">
          <a href="#"><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></a>
        </h4>
        <h5><?php echo number_format($product['price'], 2), ' CZK'; ?></h5>
        <p class="card-text">...</p>
      </div>
      <div class="card-footer">
        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>