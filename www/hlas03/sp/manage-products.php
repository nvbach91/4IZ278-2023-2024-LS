<?php
session_start();
require __DIR__ . '/include/header.php';
require_once __DIR__ . '/db/ProductsDB.php';

if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 2) {
    echo "Nemáte oprávnění přistupovat na tuto stránku.";
    exit();
}

$productsDB = new ProductsDB();
$products = $productsDB->find();

?>

<div class="container mt-5">
    <h2>Správa produktů</h2>
    <a href="manage-product" class="btn btn-primary my-3">Přidat nový produkt</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Název</th>
                <th>Počet kusů</th>
                <th>Cena</th>
                <th>Akce</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['product_id'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($product['stock'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?> Kč</td>
                    <td>
                        <a href="manage-product.php?product_id=<?php echo htmlspecialchars($product['product_id'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-warning btn-sm">Upravit</a>
                        <form action="scripts/delete-product" method="post" class="d-inline">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id'], ENT_QUOTES, 'UTF-8'); ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Smazat</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
