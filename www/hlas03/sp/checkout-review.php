<?php
session_start();
require_once __DIR__ . '/db/ProductsDB.php';

// Kontrola, zda jsou všechna potřebná data v session
if (!isset($_SESSION['basic_info']) || !isset($_SESSION['selected_address']) || !isset($_SESSION['shipping_method']) || !isset($_SESSION['payment_method']) || !isset($_SESSION['cart'])) {
    header('Location: .');
    exit;
}

$checkoutData = [
    'basic_info' => $_SESSION['basic_info'],
    'address' => $_SESSION['selected_address'],
    'shipping_method' => $_SESSION['shipping_method'],
    'payment_method' => $_SESSION['payment_method']
];

// Načítání produktů z košíku
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$productsDB = new ProductsDB();
$products = [];
$totalPrice = 0;

foreach ($cart as $product_id => $quantity) {
    $product = $productsDB->findByProductId($product_id);
    $product['quantity'] = $quantity;
    $products[] = $product;
    $totalPrice += $product['price'] * $product['quantity'];
}

// Přidání ceny dopravy a platby do celkové ceny
$totalPrice += $checkoutData['shipping_method']['price'];
$totalPrice += $checkoutData['payment_method']['fee'];

require __DIR__ . '/include/header.php';
?>

<div class="container my-5">
    <h2>Kontrola objednávky</h2>
    <div class="card mb-3">
        <div class="card-header">
            <h4>Základní informace</h4>
        </div>
        <div class="card-body">
            <p><strong>Jméno:</strong> <?php echo htmlspecialchars($checkoutData['basic_info']['first_name']); ?></p>
            <p><strong>Příjmení:</strong> <?php echo htmlspecialchars($checkoutData['basic_info']['last_name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($checkoutData['basic_info']['email']); ?></p>
            <p><strong>Telefon:</strong> <?php echo htmlspecialchars($checkoutData['basic_info']['phone']); ?></p>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h4>Adresa</h4>
        </div>
        <div class="card-body">
            <p><strong>Ulice:</strong> <?php echo htmlspecialchars($checkoutData['address']['street']); ?></p>
            <p><strong>Město:</strong> <?php echo htmlspecialchars($checkoutData['address']['city']); ?></p>
            <p><strong>PSČ:</strong> <?php echo htmlspecialchars($checkoutData['address']['zip_code']); ?></p>
            <p><strong>Země:</strong> <?php echo htmlspecialchars($checkoutData['address']['country']); ?></p>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h4>Způsob dopravy</h4>
        </div>
        <div class="card-body">
            <p><?php echo htmlspecialchars($checkoutData['shipping_method']['name'] . ' - ' . $checkoutData['shipping_method']['price'] . ' Kč'); ?></p>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h4>Způsob platby</h4>
        </div>
        <div class="card-body">
            <p><?php echo htmlspecialchars($checkoutData['payment_method']['name'] . ' - ' . $checkoutData['payment_method']['fee'] . ' Kč'); ?></p>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h4>Seznam položek</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Název produktu</th>
                        <th>Množství</th>
                        <th>Cena za kus</th>
                        <th>Celkem</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                            <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($product['price']); ?> Kč</td>
                            <td><?php echo htmlspecialchars($product['price'] * $product['quantity']); ?> Kč</td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3">Doprava (<?php echo htmlspecialchars($checkoutData['shipping_method']['name']); ?>)</td>
                        <td><?php echo htmlspecialchars($checkoutData['shipping_method']['price']); ?> Kč</td>
                    </tr>
                    <?php if ($checkoutData['payment_method']['fee'] > 0): ?>
                        <tr>
                            <td colspan="3">Platba (<?php echo htmlspecialchars($checkoutData['payment_method']['name']); ?>)</td>
                            <td><?php echo htmlspecialchars($checkoutData['payment_method']['fee']); ?> Kč</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <hr>
            <h4><strong>Celková cena: <?php echo htmlspecialchars($totalPrice); ?> Kč</strong></h4>
        </div>
    </div>
    <form action="scripts/create-order" method="post">
        <button type="submit" class="btn btn-lg btn-primary">Potvrdit objednávku</button>
    </form>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
