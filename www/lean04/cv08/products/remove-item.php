<?php

require __DIR__ . "/../database/ProductsDB.php";

session_start();

$productsDB = new ProductsDB();

if (isset($_GET['product_id']) && isset($_SESSION['cart'][$_GET['product_id']])) {
    $productId = $_GET['product_id'];

    unset($_SESSION['cart'][$productId]);

    header("Location: ../cart.php");
}
?>

<?php include __DIR__ . '/../includes/header.php'; ?>
<?php if (!isset($_GET['product_id']) || !isset($_SESSION['cart'][$_GET['product_id']])) : ?>
    <main>
        <h1>Product not found</h1>
    </main>
<?php endif; ?>
<?php include __DIR__ . '/../includes/footer.php'; ?>