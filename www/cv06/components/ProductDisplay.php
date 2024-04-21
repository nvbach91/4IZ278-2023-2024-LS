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
// $products = [
//     ['product_id' => 1, 'name' => 'Tommy Atkins', 'price' => '49.90', 'img' => 'https://github.com/nvbach91/nvbach91/assets/20724910/1983948a-b927-4235-b0bf-adb9a11abcbd'],
//     ['product_id' => 2, 'name' => 'Ataulfo',      'price' => '60.90', 'img' => 'https://github.com/nvbach91/nvbach91/assets/20724910/4e4253a0-ff3d-4730-b861-f3fbd328e463'],
//     ['product_id' => 3, 'name' => 'Kent',         'price' => '47.90', 'img' => 'https://github.com/nvbach91/nvbach91/assets/20724910/1440b402-110c-4442-9272-3cdd9b178b71'],
//     ['product_id' => 4, 'name' => 'Haden',        'price' => '51.90', 'img' => 'https://github.com/nvbach91/nvbach91/assets/20724910/7da75bd6-592b-4c81-be72-7297e006ea43'],
//     ['product_id' => 5, 'name' => 'Keitt',        'price' => '39.90', 'img' => 'https://github.com/nvbach91/nvbach91/assets/20724910/2c27b5ac-7d03-4fcd-ae0a-e58b4c239cfb'],
//     ['product_id' => 6, 'name' => 'Francine',     'price' => '59.90', 'img' => 'https://github.com/nvbach91/nvbach91/assets/20724910/9bcba5fc-ecf1-4e9e-9dda-d3f340df30f4'],
//  ];

?>

<div class="row">
  <?php foreach($products as $product): ?>
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100 product">
      <a href="#"><img class="card-img-top product-image" src="<?php echo $product['img']; ?>" alt="mango-product-image"></a>
      <div class="card-body">
        <h4 class="card-title"><a href="#"><?php echo $product['name']; ?></a></h4>
        <h5><?php echo number_format($product['price'], 2), ' ', GLOBAL_CURRENCY; ?></h5>
        <p class="card-text"><?php echo 'Lorem ipsum dolor amet sungo motte balu kareso loqes'; ?></p>
      </div>
      <div class="card-footer">
        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>