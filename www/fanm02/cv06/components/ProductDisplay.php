<?php

require_once 'db/ProductDB.php';

$productsDB = new ProductsDB();
if (isset($_GET['category_id'])) {
  $products = $productsDB->findByCategory($_GET['category_id']);
} else {
  $products = $productsDB->find([]);
}

?>
<div class="row">
  <?php foreach ($products as $product) : ?>
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <a href="#!"><img class="card-img-top my-img" height="200" width="200" src="<?php echo $product['img'] ?>" alt="<?php echo $product['name'] ?>" /></a>
        <div class="card-body">
          <h4 class="card-title"><a href="#!"><?php echo $product['name'] ?></a></h4>
          <h5><?php echo $product['price']; ?>&nbsp;Kč</h5>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
        </div>
        <div class="card-footer"><small class="text-muted">★ ★ ★ ★ ☆</small></div>
      </div>
    </div>
  <?php endforeach; ?>
</div>