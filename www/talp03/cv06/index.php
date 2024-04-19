<?php 

require __DIR__ . '/utils/database.php';

?>

<?php include __DIR__ . '/includes/head.php'; ?>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <?php include __DIR__ . '/includes/navigation.php'; ?>
        </nav>
        <!-- Section-->
        <section class="py-5">
            <?php require __DIR__ . '/includes/category.php'; ?>
            <div class="container px-4 px-lg-5 mt-5">
                <?php require __DIR__ . '/includes/products.php'; ?>
            </div>
        </section>
<?php include __DIR__ . '/includes/footer.php'; ?>
