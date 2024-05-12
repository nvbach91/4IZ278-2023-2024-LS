<?php
require_once __DIR__ . '/../db/ProductsDatabase.php';

$productsDB = new ProductsDatabase();

if (isset($_GET['idProductType'])) {
  $products = $productsDB->readProductsByType($_GET['idProductType']);
} else {
  $products = $productsDB->readAllProducts();
}

?>

<div class="row">
  <?php foreach($products as $product): ?>
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100 product">
      <a href="#">
        <img class="card-img-top product-image" src="<?php echo htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="tea-package-image">
      </a>
      <div class="card-body">
        <h4 class="card-title">
          <a href="#"><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></a>
        </h4>
        <h5><?php echo number_format($product['price'], 2), ' CZK'; ?></h5>
        <p class="card-text"><?php echo htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?> </p>
      </div>
      <div>
        <button>Add to Cart</button>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>