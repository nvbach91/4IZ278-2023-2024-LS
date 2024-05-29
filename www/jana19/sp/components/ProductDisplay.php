<?php
require_once __DIR__ . '/../db/ProductsDatabase.php';

$currentUrlParams = $_SERVER['QUERY_STRING'];

$urlParamsArr = explode("&", $currentUrlParams);

$productTypeId = 0;
for($i = 0; $i < count($urlParamsArr); $i++){
    if(str_contains($urlParamsArr[$i], 'productType')){
        $productTypeId = explode('=',$urlParamsArr[$i])[1];
    }
}


$productsDB = new ProductsDatabase();

if(count($urlParamsArr) == 1 && $urlParamsArr[0] == "" ) {
  $products = $productsDB->readAllProducts();
}
else if (count($urlParamsArr) > 1 || (count($urlParamsArr) == 1 && $urlParamsArr[0] != " " )) {
  $offset = 0;
  $products = $productsDB->readProcutsByQuerryString($urlParamsArr, $offset);
} 

?>

<?php // require_once __DIR__ . '/ProductPagination.php' ?>

<?php 
// $products = array_slice($items, 0, $nItemsPerPagination);
?>

<br>
<div class="row">
  <?php foreach($products as $product): ?>
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100 product">
      <a href="../sp/details.php?productId=<?php echo htmlspecialchars($product['idProduct'], ENT_QUOTES, 'UTF-8'); ?>">
        <img class="card-img-top product-image" src="<?php echo htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="tea-package-image">
      </a>
      <div class="card-body">
        <h2 class="card-title">
          <a href="../sp/details.php?productId=<?php echo htmlspecialchars($product['idProduct'], ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>
          </a>
        </h2>
        <h3><?php if ($product['discount'] > 0) {echo number_format($product['price'] * (1 - 0.01 * $product['discount']), 2), ' CZK';} else {echo number_format($product['price'], 2), ' CZK'; }?></h3>
        <p><s><?php if ($product['discount'] > 0) {echo number_format($product['price'], 2), ' CZK';} else {echo '';}?></s><b class="<?php if ($product['discount'] > 0) {echo 'green';} ?>"><?php if ($product['discount'] > 0) {echo ' Save ', number_format($product['discount'], 0), ' %';} else {echo '';}?></b><?php if ($product['discount'] > 0) {echo '';} else {echo 'Unfortunately, there is no discount at the moment.';}?></p>
        <p>The product is currently <b class="<?php if ($product['isAvailable'] == false) {echo 'red';} else {echo 'green'; }?>"><?php if ($product['isAvailable'] == false) {echo 'sold out';} else {echo 'in Stock'; }?></b><?php if ($product['isAvailable'] == false) {echo ', we apologize for the inconvenience.';} else {echo '!'; }?></p>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>