<?php

require __DIR__ . "/../database/ProductsDB.php";

$productsDB = new ProductsDB();
$products = empty($_GET['category_id']) ? $productsDB->findAll() : $productsDB->findByCategory([
    'category_id' => $_GET['category_id']
]);

?>

<div class="row">
    <?php foreach ($products as $product) : ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <a href="#!"><img class="card-img-top" src=<?php echo $product['img'] ?> alt="..." /></a>
                <div class="card-body">
                    <h4 class="card-title"><a href="#!"><?php echo $product['name'] ?></a></h4>
                    <h5>$<?php echo $product['price'] ?></h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                </div>
                <div class="card-footer"><small class="text-muted">★ ★ ★ ★ ☆</small></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>