<?php
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/userRequired.php';

// session_start();
?>
<main class="container">
    <h1>My shopping cart</h1>
    <div>
        <p class="my-4"><a class="btn btn-secondary" href="index.php">&lt;&lt; Back to Browsing</a></p>
    </div>
    <?php if (!empty($_SESSION['cart'])) : ?>
        Total products selected: <?= count($_SESSION['cart']) ?>
        <br><br>
        <div class="products">
            <?php foreach ($_SESSION['cart'] as $item) : ?>

                <div class="card product" style="width: calc(100% / 3)">
                    <a href="details.php?productId=<?php echo htmlspecialchars($item['idProduct'], ENT_QUOTES, 'UTF-8'); ?>">
                        <img class="card-img-top" src="<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="tea-package-image">
                    </a>
                    <div class="card-body">
                        <h2 class="card-title">
                            <a href="details.php?productId=<?php echo htmlspecialchars($item['idProduct'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h2>
                        <hr>
                        <div class="card-subtitle">Base price: <?= number_format($item['price'], 2), ' CZK'; ?></div>
                        <div class="card-subtitle">Discount: <?= number_format($item['discount'], 0) ?> %</div>
                        <hr>
                        <div class="card-subtitle">Price per One: <?= number_format($item['price'] * (1 - 0.01 * $item['discount']), 2), ' CZK'; ?></div>
                        <hr>
                        <div class="card-text">Quantity: <?= number_format($item['quantity'], 0) ?></div>
                        <div class="card-subtitle">Price in total: <?= number_format(($item['price'] * (1 - 0.01 * $item['discount'])) * $item['quantity'], 2), ' CZK'; ?></div>
                        <hr>
                        <form action="./components/ProductRemove.php" method="POST">
                            <input type="hidden" name="productId" value="<?= htmlspecialchars($item['idProduct'], ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
            <br><br>
        <form action="order.php" method="POST">
            <button type="submit" class="btn btn-info">Place Order &gt;&gt;</button>
        </form>
    <?php else : ?>
        <h5>No products have been added yet</h5>
    <?php endif; ?>
    <br><br>


</main>
<?php require __DIR__ . '/includes/footer.php'; ?>