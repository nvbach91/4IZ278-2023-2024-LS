<?php

require __DIR__ . "/../database/ProductsDB.php";

session_start();

$productsDB = new ProductsDB();

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    $exists = $productsDB->exists(['product_id' => $productId]);

    if ($exists) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $product = $productsDB->find(['product_id' => $productId]);

        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['data'] = $product;
            $_SESSION['cart'][$productId]['count'] = 1;
        } else {
            $_SESSION['cart'][$productId]['count']++;
        }

        header("Location: ../cart.php");
    }
}
?>

<?php include __DIR__ . '/../includes/header.php'; ?>
<?php if (!$exists) : ?>
    <main>
        <h1>Product not found</h1>
    </main>
<?php endif; ?>
<?php include __DIR__ . '/../includes/footer.php'; ?>