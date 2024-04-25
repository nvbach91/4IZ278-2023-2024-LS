<?php

require __DIR__ . "/../database/ProductsDB.php";

session_start();

$productsDB = new ProductsDB();

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    $exists = $productsDB->exists(['product_id' => $productId]);

    if ($exists) {
        $productsDB->delete(['product_id' => $productId]);
    }

    header("Location: ../index.php");
}
?>

<?php include __DIR__ . '/../includes/header.php'; ?>
<?php if (!isset($_GET['product_id']) || !$exists) : ?>
    <main>
        <h1>Product not found</h1>
    </main>
<?php endif; ?>
<?php include __DIR__ . '/../includes/footer.php'; ?>