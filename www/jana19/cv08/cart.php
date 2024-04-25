<?php
session_start();
require_once __DIR__ . '/db/ProductsDB.php';

$productsDB = new ProductDB();
$goodsCart = $productsDB->findGoodsForCart();
$columnsCart = $productsDB->findColumnsForCart();
?>




<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <h1>My shopping cart</h1>
    <?php if ($goodsCart !== null) : ?>
        Total goods selected: <?= count($goodsCart) ?>
    <?php endif ?>
    <br><br>
    <a href="index.php">Back to store!</a>
    <br><br>
    <?php if(@$goodsCart): ?>
    <div class="products">
        <?php foreach($goodsCart as $row): ?>
        <div class="card product" style="width: calc(100% / 3)">
            <img class="card-img-top" src="https://via.placeholder.com/300x150" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['name'] ?></h5>
                <div class="card-subtitle"><?php echo $row['price'] ?></div>
                <div class="card-text"><?php echo $row['description'] ?></div>
                <form action="remove-item.php" method="POST">
                    <input class="d-none" name="id" value="<?php echo $row['good_id'] ?>">
                    <button type="submit" class="btn btn-danger">Remove</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <h5>No goods yet</h5>
    <?php endif; ?>
</main>


<?php require __DIR__ . '/includes/footer.php'; ?>