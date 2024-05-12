<?php 
require_once __DIR__ . '/../db/ProductsDB.php'; 
require_once __DIR__ . '/../config/global.php'; 
?>
<?php


$productsDB = new ProductsDB();
if (isset($_GET['category_id'])) {
  $products = $productsDB->findByCategory($_GET['category_id']);
} else {
  $products = $productsDB->find();
}

?>

<div class="row">
  <?php foreach($products as $product): ?>
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100 product">
      <a href="#"><img class="card-img-top product-image" src="<?php echo $product['img']; ?>" alt="softball-product-image"></a>
          <h4 class="card-title"><a href="#"><?php echo $product['name']; ?></a></h4>
          <h5><?php echo number_format($product['price'], 2), ' ', GLOBAL_CURRENCY; ?></h5>
          <p class="card-text"><?php echo $product['description']; ?></p>
    </div>
  </div>
  <?php endforeach; ?>
</div>