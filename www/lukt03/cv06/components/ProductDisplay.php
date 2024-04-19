<?php

require_once __DIR__ . '/../db/ProductsDB.php';

$productsDb = new ProductsDB();
if (isset($_GET['category_id'])) {
	$products = $productsDb->findByCategory($_GET['category_id']);
} else {
	$products = $productsDb->find();
}

?>

<div class="row">
	<?php foreach ($products as $product): ?>
	<div class="col-lg-4 col-md-6 mb-4">
		<div class="card h-100">
			<a href="#!"><img class="card-img-top" src="<?php echo $product['img'] ?>" alt="<?php echo $product['name'] ?>" /></a>
			<div class="card-body">
				<h4 class="card-title"><a href="#!"><?php echo $product['name'] ?></a></h4>
				<h5><?php echo $product['price'] . ' Kč'; ?></h5>
				<p class="card-text">Cink cink!</p>
			</div>
			<div class="card-footer"><small class="text-muted">★ ★ ★ ★ ★</small></div>
		</div>
	</div>
	<?php endforeach; ?>
</div>
