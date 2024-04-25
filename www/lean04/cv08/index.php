<?php include __DIR__ . '/includes/header.php'; ?>
<main>
    <div class="container">
        <?php if (isset($_COOKIE['name'])) : ?>
            <div class="row mb-4">
                <a href="create-item.php" class="btn btn-primary mt-3">Add new item</a>
            </div>
        <?php endif; ?>
        <?php require __DIR__ . '/components/ProductDisplay.php'; ?>
    </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>