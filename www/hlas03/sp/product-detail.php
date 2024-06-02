<?php require __DIR__ . '/include/header.php'; ?>

<main class="container">
    <div class="row">
        <?php require __DIR__ . '/components/CategoryDisplay.php'; ?>
        <div class="col-lg-9 mt-5">
            <?php require __DIR__ . '/components/ProductDetailDisplay.php'; ?>
        </div>
    </div>
</main>

<?php require __DIR__ . '/include/footer.php'; ?>