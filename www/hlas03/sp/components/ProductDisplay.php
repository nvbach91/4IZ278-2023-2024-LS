<?php 
require_once __DIR__ . '/../db/ProductsDB.php'; 
require_once __DIR__ . '/../config/global.php'; 
?>
<?php


$productsDB = new ProductsDB();
$products = null;
$product = null;
if (isset($_GET['category_id'])) {
  $products = $productsDB->findByCategory($_GET['category_id']);
}
elseif (isset($_GET['product_id'])) {
  $product = $productsDB->findByProductId($_GET['product_id']);
} else {
  $products = $productsDB->find();
}

?>
<?php if($product): ?>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <img class="img-fluid product-image" src="./assets/product_img/<?php echo $product['product_id'];?>.<?php echo $product['img_format'];?>" alt="softball-product-image">
    </div>
    <div class="col-md-6">
      <h2 class="product-title"><?php echo $product['name']; ?></h2>
      <h4 class="product-price"><?php echo number_format($product['price']), ' ', GLOBAL_CURRENCY; ?></h4>
      <p class="product-description"><?php echo $product['description']; ?></p>
      <div class="product-details">
        <p><strong>Availability:</strong> <?php echo $product['stock']; ?></p>
      </div>
      <div class="mt-4">
        <button class="btn btn-primary">Add to Cart</button>
      </div>
    </div>
  </div>
</div>

<?php else: ?>
<div class="container mt-5">
  <div class="row">
    <?php foreach($products as $product): ?>
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100 text-center p-2">
        <a href=".?product_id=<?php echo $product['product_id']; ?>">
          <img class="card-img-top product-image" src="./assets/product_img/<?php echo $product['product_id'];?>.<?php echo $product['img_format'];?>" alt="softball-product-image">
        </a>
        <div class="card-body d-flex flex-column">
          <h5 class="card-title"><?php echo $product['name']; ?></h5>
          <div class="mt-auto">
            <h6 class="card-price"><?php echo number_format($product['price']), ' ', GLOBAL_CURRENCY; ?></h6>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>