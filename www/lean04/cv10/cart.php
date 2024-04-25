<?php require __DIR__ . '/auth/registeredUserRequired.php'; ?>
<?php

session_start();

?>

<?php include __DIR__ . '/includes/header.php'; ?>
<main>
    <div class="container">
        <div class="row">
            <?php if (isset($_SESSION['cart'])) : ?>
                <?php foreach ($_SESSION['cart'] as $id => $product) : ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="#!"><img class="card-img-top" src=<?php echo $product['data']['img'] ?> alt="..." /></a>
                            <div class="card-body">
                                <h4 class="card-title"><a href="#!"><?php echo $product['data']['name'] ?></a><?php echo $product['count'] == 1 ? '' : " (" . $product['count'] . "x)" ?></h4>
                                <h5>$<?php echo $product['data']['price'] ?></h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">★ ★ ★ ★ ☆</small>
                                <?php if (isset($_COOKIE['user_id'])) : ?>
                                    <a href="products/remove-item.php?product_id=<?php echo $product['data']['good_id'] ?>" class="btn btn-primary mt-3">Remove item</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <h1>Cart is empty</h1>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>