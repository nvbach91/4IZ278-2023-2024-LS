<?php
session_start();
require_once __DIR__ . '/db/ProductsDB.php';

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$productsDB = new ProductsDB();
$products = [];

foreach ($cart as $product_id => $quantity) {
    $product = $productsDB->findByProductId((int)$product_id);
    if ($product) {
        $product['quantity'] = (int)$quantity;
        $products[] = $product;
    }
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
                    <th>Celkem</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?> Kč</td>
                        <td><?php echo htmlspecialchars($product['quantity'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($product['price'] * $product['quantity'], ENT_QUOTES, 'UTF-8'); ?> Kč</td>
                        <td>
                            <form method="post" action="scripts/remove-from-cart">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Odebrat</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><strong>Celková cena: <?php echo htmlspecialchars($total_price, ENT_QUOTES, 'UTF-8'); ?> Kč</strong></p>
        <a href="select-basic-info.php" class="btn btn-primary">Pokračovat k pokladně</a>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
