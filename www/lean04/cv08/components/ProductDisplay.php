<?php

require __DIR__ . "/../database/ProductsDB.php";

$itemsPerPage = 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;

$productsDB = new ProductsDB();

$products = $productsDB->findAllPaginated($itemsPerPage, $offset);
$productCount = $productsDB->getCount();

?>

<div class="row">
    <nav>
        <ul class="pagination">
            <?php for ($i = 0; $i < ceil($productCount / $itemsPerPage); $i++) : ?>
                <li class="page-item <?php echo $page == ($i + 1) ? 'active' : '' ?>"><a class="page-link" href=<?php echo "?page=" . ($i + 1) ?>><?php echo $i + 1 ?></a></li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
<div class="row">
    <?php foreach ($products as $product) : ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <a href="#!"><img class="card-img-top" src=<?php echo $product['img'] ?> alt="..." /></a>
                <div class="card-body">
                    <h4 class="card-title"><a href="#!"><?php echo $product['name'] ?></a></h4>
                    <h5>$<?php echo $product['price'] ?></h5>
                    <p class="card-text"><?php echo $product['description'] ?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">★ ★ ★ ★ ☆</small>
                    <?php if (isset($_COOKIE['name'])) : ?>
                        <a href="products/buy.php?product_id=<?php echo $product['good_id'] ?>" class="btn btn-primary mt-3">Add to cart</a>
                        <a href="edit-item.php?product_id=<?php echo $product['good_id'] ?>" class="btn btn-primary mt-3">Edit item</a>
                        <a href="products/delete-item.php?product_id=<?php echo $product['good_id'] ?>" class="btn btn-primary mt-3">Delete item</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="row">
    <nav>
        <ul class="pagination">
            <?php for ($i = 0; $i < ceil($productCount / $itemsPerPage); $i++) : ?>
                <li class="page-item <?php echo $page == ($i + 1) ? 'active' : '' ?>"><a class="page-link" href=<?php echo "?page=" . ($i + 1) ?>><?php echo $i + 1 ?></a></li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>