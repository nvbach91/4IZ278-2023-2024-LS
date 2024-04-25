<?php

require_once __DIR__ . './../db/ProductsDB.php';

$productsDB = new ProductDB();

$nItemsPerPagination = 4; // dá se měnit - mělo by se dynamicky přizpůsobit

$nItems = $productsDB->countAllProducts();

$nPaginations = ceil($nItems / $nItemsPerPagination);
$nItemsOnLastPagination = $nItems % $nItemsPerPagination;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $nItemsPerPagination;

$items = $productsDB->findItemsPage($offset, $nItemsPerPagination);

$displayItems = array_slice($items, 0, $nItemsPerPagination);

?>

<!-- <div>pocet produktu: <?php echo $nItems ?></div>
<div>pocet strankovani: <?php echo $nPaginations ?></div>
<div>pocet produktu na posledni strance: <?php echo $nItemsOnLastPagination ?></div> -->

<div class="pagination">
    <?php for ($i = 0; $i < $nPaginations; $i++) { ?>
        <a href="?page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a> <!-- i+1 bay to nezačínalo od nuly -->
    <?php } ?>
</div>

<div class="row">
    <?php foreach ($displayItems as $item) : ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 product">
                <a href="#">
                    <img class="card-img-top product-image" src="<?php echo $item['img']; ?>" alt="img">
                </a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#"><?php echo $item['name']; ?></a>
                    </h4>
                    <h5><?php echo number_format($item['price'], 2), ' CZK'; ?></h5>
                    <p class="card-text">...</p>
                    <div class="card-controls">
                        <a class="btn btn-secondary card-link" href='./buy.php?id=<?php echo $item['good_id'] ?>'>Buy</a>
                        <a class="btn btn-secondary card-link" href='./update.php?id=<?php echo $item['good_id'] ?>'>Edit</a>
                        <a class="btn btn-secondary card-link" href='./delete.php?id=<?php echo $item['good_id'] ?>'>Delete</a>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="pagination">
    <?php for ($i = 0; $i < $nPaginations; $i++) { ?>
        <a href="?page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a> <!-- i+1 bay to nezačínalo od nuly -->
    <?php } ?>
</div>