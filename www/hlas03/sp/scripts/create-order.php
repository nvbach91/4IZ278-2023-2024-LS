<?php
session_start();
require_once __DIR__ . '/../db/OrdersDB.php';
require_once __DIR__ . '/../db/OrderItemsDB.php';
require_once __DIR__ . '/../db/ProductsDB.php';

if (!isset($_SESSION['user_id']) && !isset($_SESSION['guest_user_id'])) {
    header('Location: ../login.php');
    exit;
}

try {
    // Připravte data z košíku a session
    $checkoutData = [
        'basic_info' => $_SESSION['basic_info'],
        'address' => $_SESSION['selected_address'],
        'shipping_method' => $_SESSION['shipping_method'],
        'payment_method' => $_SESSION['payment_method']
    ];

    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    $totalPrice = 0;
    $productsDB = new ProductsDB();

    // Kontrola, zda jsou všechny produkty na skladě
    foreach ($cart as $product_id => $quantity) {
        $product = $productsDB->findByProductId($product_id);
        if ($product['stock'] < $quantity) {
            throw new Exception('Produkt ' . $product['name'] . ' není na skladě v požadovaném množství.');
        }
        $totalPrice += $quantity * $product['price'];
    }
    $totalPrice += $checkoutData['shipping_method']['price'];
    $totalPrice += $checkoutData['payment_method']['fee'];

    // Vytvoření objednávky
    $ordersDB = new OrdersDB();
    $orderData = [
        'status' => 'active',
        'created_at' => date('Y-m-d H:i:s'),
        'user_id' => $_SESSION['user_id'] ?? null,
        'payment_method_id' => $checkoutData['payment_method']['payment_method_id'],
        'shipping_method_id' => $checkoutData['shipping_method']['shipping_methods_id'],
        'host_user_id' => $_SESSION['guest_user_id'] ?? null,
        'address_id' => $checkoutData['address']['address_id']
    ];
    $order_id = $ordersDB->create($orderData);

    // Vytvoření položek objednávky
    $orderItemsDB = new OrderItemsDB();
    foreach ($cart as $product_id => $quantity) {
        $product = $productsDB->findByProductId($product_id);
        $orderItemsDB->create([
            'order_id' => $order_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $product['price']
        ]);
        // Snížení počtu kusů na skladě
        $productsDB->updateStock($product_id, $product['stock'] - $quantity);
    }

    // Vymazání košíku
    unset($_SESSION['cart']);
    unset($_SESSION['basic_info']);
    unset($_SESSION['selected_address']);
    unset($_SESSION['shipping_method']);
    unset($_SESSION['payment_method']);

    // Přesměrování na stránku potvrzení objednávky
    header('Location: ../order-confirmation.php?order_id=' . $order_id);
    exit;

} catch (Exception $e) {
    // Vymazání session dat při neúspěchu
    unset($_SESSION['cart']);
    unset($_SESSION['basic_info']);
    unset($_SESSION['selected_address']);
    unset($_SESSION['shipping_method']);
    unset($_SESSION['payment_method']);

    // Přesměrování na chybovou stránku nebo zpět na login s chybovým hlášením
    header('Location: ../order-error.php?message=' . urlencode($e->getMessage()));
    exit;
}
?>
