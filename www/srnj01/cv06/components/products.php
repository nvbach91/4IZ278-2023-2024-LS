<?php

require_once('db/eshop.php');
function getFilteredProducts($category_id = null)
{
  $db = new ProductsDB();
  if (!$category_id) {
    return $db->find();
  }
  return $db->findByCategory($category_id);
}

$products = getFilteredProducts(isset($_GET['ctg']) ? $_GET['ctg'] : null);

?>

<div class="row">
  <?php foreach ($products as $product) {
  ?>
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <img class="card-img-top" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name'] ?>" />
        <div class="card-body">
          <h4 class="card-title">
            <?php echo $product['name']; ?>
          </h4>
          <h5><?php echo $product['price']; ?>&nbsp;Kč</h5>
        </div>
      </div>
    </div>
  <?php
  } ?>
</div>