<?php require __DIR__ . '/includes/header.php'; ?>


<main class="container">
    <div class="row">
        <div class="col-lg-3">
            <h1 class="my-4">Ahmad Tea Shop</h1>
            <?php require __DIR__ . '/components/ProductTypeDisplay.php'; ?>
        </div>
        <div class="col-lg-9">
            <?php // require __DIR__ . '/components/SlideDisplay.php'; ?>
            <?php require __DIR__ . '/components/ProductDisplay.php'; ?>
        </div>
    </div>
</main>


<?php require __DIR__ . '/includes/footer.php'; ?>