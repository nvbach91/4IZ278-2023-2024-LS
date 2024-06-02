<?php
session_start();
require_once __DIR__ . '/db/ProductsDB.php';

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$productsDB = new ProductsDB();
$products = [];

foreach ($cart as $product_id => $quantity) {
    $product = $productsDB->findByProductId($product_id);
    $product['quantity'] = $quantity;
    $products[] = $product;
}

$total_price = array_sum(array_map(function ($product) {
    return $product['price'] * $product['quantity'];
}, $products));

require __DIR__ . '/include/header.php';
?>

<div class="container mt-5">
    <h2>Košík</h2>
    <?php if (empty($products)): ?>
        <p>Váš košík je prázdný.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Název produktu</th>
                    <th>Cena</th>
                    <th>Množství</th>
                    <th>Celková cena</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo htmlspecialchars($product['price']); ?> Kč</td>
                        <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($product['price'] * $product['quantity']); ?> Kč</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>Celková cena: <?php echo htmlspecialchars($total_price); ?> Kč</p>
        <a href="checkout.php" class="btn btn-primary">Pokračovat k pokladně</a>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
